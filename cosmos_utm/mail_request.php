<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$sLogsFolder = dirname($_SERVER['DOCUMENT_ROOT']) . '/logs';//путь к каталогу логов
$sLogPath = $sLogsFolder . '/mail_error.log';//путь к логу ошибок

$oMail = new Cosmos_UTM_Mail();
$aUnSeenLetters = $oMail->getLetters('UNSEEN');


if( isset($aUnSeenLetters) && count($aUnSeenLetters) > 0 ){
	
	foreach ($aUnSeenLetters as $iLetterID => $aLetter) {
		
		preg_match_all("/От\s*кого:(.*@[A-zА-я-0-9]*\.[A-zА-я]{2,6})/iu", $aLetter['body'], $aContactMatches);
		if( isset($aContactMatches[1][0]) && $aContactMatches[1][0] ){
			$sClientContact = str_replace(array('&lt;', '&gt;'), array('<',''), $aContactMatches[1][0]);
			$aClientContact = array();
			list($aClientContact['name'], $aClientContact['mail']) = explode("<", trim($sClientContact));
		}

		foreach($aLetter['headers']['from'] as $aFromMail){
			$aHitArray = array();
			$sFromMail = implode('@', array($aFromMail['mailbox'], $aFromMail['host']));
			$oCosmosHit = new Cosmos_UTM_Hit;
			try {
				$aHitArray = $oCosmosHit->getByChannel( $sFromMail );
				break;
			} catch ( Cosmos_Exception $e ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . " " . $e->getMessage() . "\n" . print_r($aLetter, true) . "\n", 
						FILE_APPEND
					);
			}
		}
		
		if ( isset( $aHitArray ) && $aHitArray ) {

			$aCosmosConfigGaParam = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_ga' );

			$Cosmos_UTM_GA = new Cosmos_UTM_GA( $aCosmosConfigGaParam['ga_tracking_id'] );
			$Cosmos_UTM_GA->setParams( array( 'cid' => $aHitArray['CidGA'] ) );

			$aParam = array(
				't' => 'event',
				'ec' => 'sendmail',
				'ea' => $sFromMail, // мыло на которое была отправка
				'el' => ( isset($aClientContact['mail']) && $aClientContact['mail'] ? trim($aClientContact['mail']) : 'notfound' ), // мыло с которого была отправка
			);
			if ( !$Cosmos_UTM_GA->post( $aParam ) ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . " Не удалось отправить информацию о письме\n" . print_r($aLetter, true) . "\n", 
						FILE_APPEND
					);
			}

			$iContactID = '';
			$aCosmosConfigCrmParam = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_crm' );
			$iAssignedUserId = ( isset($aCosmosConfigCrmParam['crm_assigned_userid']) && $aCosmosConfigCrmParam['crm_assigned_userid'] ? $aCosmosConfigCrmParam['crm_assigned_userid'] : 1 );

			//ищем существующий контакт в CRM по email клиента
			if( isset($aClientContact['mail']) && $aClientContact['mail'] ){
				$oCRM = new Cosmos_UTM_CRM();
				$aResult = $oCRM->callMethod(
						'crm.contact.list', 
						array(
							'filter' => array('EMAIL' => trim($aClientContact['mail'])), 
							'select' => array('ID')
						)
					);

				if( !( isset($aResult['total']) && $aResult['total'] ) ){
					//если контакт не найден - создаём его
					$aResult = $oCRM->callMethod(
							'crm.contact.add', 
							array(
								'fields' => array(
									'NAME' => ( isset($aClientContact['name']) && $aClientContact['name'] ? trim($aClientContact['name']) : "Письмо с сайта" ), 
									'LAST_NAME' => trim($aClientContact['mail']), 
									'OPENED' => 'Y', 
									'ASSIGNED_BY_ID' => $iAssignedUserId, 
									'TYPE_ID' => 'CLIENT',
									'SOURCE_ID' => 'EMAIL',
									'EMAIL' => array(
										array(
											"VALUE" => trim($aClientContact['mail']), 
											"VALUE_TYPE" => "WORK" 
										)
									)
								)
							)
						);

					if( isset($aResult['result']) && $aResult['result'] ){
						$iContactID = $aResult['result'];
					}else{
						//логировать
						file_put_contents(
								$sLogPath, 
								date('d.m.Y H:i:s', $iTimeStump) . " Не удалось добавить контакт в CRM\n" . print_r($aLetter, true) . "\n", 
								FILE_APPEND
							);
					}	
				}
			}


			$aResult = $oCRM->callMethod(
					'crm.deal.add', 
					array(
						'fields' => array(
							'TITLE' => "Письмо с сайта " . ( isset($aClientContact['mail']) && $aClientContact['mail'] ? "[" . trim($aClientContact['mail']) . "]" : "" ), 
							'TYPE_ID' => 'SERVICES',
							'STAGE_ID' => 'NEW', 
							'CONTACT_ID' => $iContactID, 
							'OPENED' => 'Y', 
							'ASSIGNED_BY_ID' => $iAssignedUserId, 
							'CURRENCY_ID' => 'RUB', 
							'BEGINDATE' => date('d.m.Y'), 
							'COMMENTS' => $aLetter['body'], 
							$aCosmosConfigCrmParam['crm_cidga_field'] => $aHitArray['CidGA'], 
							$aCosmosConfigCrmParam['crm_laststatus_field'] => 'NEW',
							$aCosmosConfigCrmParam['crm_channel_field'] => $aHitArray['channel_name']
						)
					)
				);

			if ( !( isset($aResult['result']) && $aResult['result'] ) ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . " Не удалось добавить сделку в CRM\n" . print_r($aLetter, true) . "\n", 
						FILE_APPEND
					);
			}else{
				$oMail->markRead($iLetterID);
			}

		} else {
			//логировать
			file_put_contents(
					$sLogPath, 
					date('d.m.Y H:i:s', $iTimeStump) . " Не удалось получить информацию о CidGA\n" . print_r($aLetter, true) . "\n", 
					FILE_APPEND
				);
		}

	}

}