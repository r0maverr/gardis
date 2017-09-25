<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$sLogsFolder = dirname($_SERVER['DOCUMENT_ROOT']) . '/logs';//путь к каталогу логов
$sLogPath = $sLogsFolder . '/crm_error.log';//путь к логу ошибок
$iTimeStump = time();
$bWorked = false;//индикатор отработки скрипта

/**
 * @todo сделать компонент обрабатывающий GET/POST параметры от Bitrix24 и выполняющие действия ниже
 */

/**
 * Запрос на авторизацию, получение токенов от Bitrix24
 * 
 */
if( isset($_REQUEST['code']) && $_REQUEST['code'] ){
	
	echo "<h1>Инициализация системы</h1>";
	echo "Получили request token.<br>";
	
	$oCosmosUtmCrm = new Cosmos_UTM_CRM();	
	$sResult = $oCosmosUtmCrm->initTokens( trim($_REQUEST['code']) );
	
	echo "Запрашиваем первоначальный refresh token:<br>";
	echo $sResult;
	echo "<br>";
	echo "Проверяем существование обработчика события обновления сделки:<br>";
		
	$aCosmosConfigCrmHandlers = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_handlers' );
	$sServerProtocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://' );
	$sHandlerPath = $sServerProtocol . $_SERVER['SERVER_NAME'] . trim( $aCosmosConfigCrmHandlers['crm_handler'] );
	
	//установка обработчика на обновление сделки, если его нет
	$bEvent = false;
	$oCRM = new Cosmos_UTM_CRM();
	$aResult = $oCRM->callMethod(
		'event.get', 
		array()
	);
	
	//поиск среди установленных обработчиков нужного нам onCrmDealUpdate
	if( isset($aResult['result']) && count($aResult['result']) > 0 ){
		foreach ($aResult['result'] as $aEventHandler) {
			if( strtolower($aEventHandler['event']) ==  'oncrmdealupdate' 
					&& $aEventHandler['handler'] ==  $sHandlerPath ){
				
					echo "Обработчик успешно найден.<br>";
					$bEvent = true;
					break;
			}
		}
	}
	
	//если не найдено, то добавляем обработчик
	if( !$bEvent ){
		echo "Обработчик не найден - добавляем.<br>";
		$aResult = $oCRM->callMethod(
				'event.bind', 
				array(
					'event' => 'onCrmDealUpdate', 
					'handler' => $sHandlerPath
				)
			);
		if( isset($aResult['result']) && $aResult['result'] ){
			echo "Обработчик успешно добавлен.<br>";
		}elseif(isset($aResult['error']) && $aResult['error']){
			echo "Ошибка! " . $aResult['error_description'] . "<br>";
		}else{
			echo "Неизвестная ошибка! Попробуйте повторить позже.<br>";
		}
	}
	$bWorked = true;
}


/**
 * Обработка события изменения сделки в Bitrix24
 * 
 */
if( isset($_REQUEST['event']) && strtolower($_REQUEST['event']) == 'oncrmdealupdate' ){
	if( isset($_REQUEST['data']['FIELDS']['ID']) && $_REQUEST['data']['FIELDS']['ID'] ){
	
		$iUpdateDealID = $_REQUEST['data']['FIELDS']['ID'];//ID сделки

		//получаем информацию о сделке
		$oCRM = new Cosmos_UTM_CRM();
		$aResult = $oCRM->callMethod(
				'crm.deal.get', 
				array(
					'id' => $iUpdateDealID
				)
			);

		if( isset($aResult['result']) && count($aResult['result']) > 0 ){

			//если статус сделки не изменился, то ничего не делаем
			$aCosmosConfigCrmParam = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_crm' );
			if( $aResult['result']['STAGE_ID'] == $aResult['result'][$aCosmosConfigCrmParam['crm_laststatus_field']] ){
				return;
			}

			//если статус сделки не указан в конфиге, то ничего не делаем
			$aCosmosConfigCrmStatuses = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_crm_processed_statuses' );
			if ( !( $sTypeGaEvent = array_search($aResult['result']['STAGE_ID'], $aCosmosConfigCrmStatuses) ) ){
				return;
			}

			$aCosmosConfigGaParam = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_ga' );

			//отправляем информацию о смене статуса в Google Analytics
			$Cosmos_UTM_GA = new Cosmos_UTM_GA( $aCosmosConfigGaParam['ga_tracking_id'] );
			$Cosmos_UTM_GA->setParams( array( 'cid' => $aResult['result'][$aCosmosConfigCrmParam['crm_cidga_field']] ) );

			$aParam = array(
				't' => 'pageview',
				'ec' => '',
				'dp' => $aCosmosConfigGaParam['ga_page_' . $sTypeGaEvent],
				'dt' => 'Изменение статуса: ' . $aResult['result']['STAGE_ID']
			);
			if ( !$Cosmos_UTM_GA->post( $aParam ) ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . ' Не удалось зафиксировать посещение виртуальной страницы смены статуса сделки №' . $iUpdateDealID . "\n", 
						FILE_APPEND
					);
			}

			$aParam = array(
				't' => 'event',
				'ec' => $aCosmosConfigGaParam['ga_event_' . $sTypeGaEvent],
				'ea' => $aCosmosConfigGaParam['ga_event_' . $sTypeGaEvent],
				'el' => $iUpdateDealID,
			);
			if( isset($aResult['result']['OPPORTUNITY']) && $aResult['result']['OPPORTUNITY'] ){
				//если есть цена сделки - отправляем её тоже
				$aParam['ev'] = intval($aResult['result']['OPPORTUNITY']);
			}
			if ( !$Cosmos_UTM_GA->post( $aParam ) ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . ' Не удалось отправить информацию о смене статуса сделки №' . $iUpdateDealID . "\n", 
						FILE_APPEND
					);
			}

			//меняем у сделки поле "Последний статус" на только что установленный
			$aResult = $oCRM->callMethod(
					'crm.deal.update', 
					array(
						'id' => $iUpdateDealID,
						'fields' => array(
							$aCosmosConfigCrmParam['crm_laststatus_field'] => $aResult['result']['STAGE_ID']
						)
					)
				);
			if ( !( isset($aResult['result']) && $aResult['result'] ) ) {
				//логировать
				file_put_contents(
						$sLogPath, 
						date('d.m.Y H:i:s', $iTimeStump) . ' Не удалось обновить информацию о сделке №' . $iUpdateDealID . "\n", 
						FILE_APPEND
					);
			}
		}else{
			//логировать
			file_put_contents(
					$sLogPath, 
					date('d.m.Y H:i:s', $iTimeStump) . " Не найдена сделка №" . $iUpdateDealID . "\n", 
					FILE_APPEND
				);
		}
	}else{
		//логировать
		file_put_contents(
				$sLogPath, 
				date('d.m.Y H:i:s', $iTimeStump) . " Не найден ID обновляемой сделки\n" . print_r($_REQUEST, true) . "\n", 
				FILE_APPEND
			);
	}
	$bWorked = true;
}

if ( !$bWorked ) {
	//логировать
	file_put_contents(
			$sLogPath, 
			date('d.m.Y H:i:s', $iTimeStump) . "Пустой запрос к скрипту.\n", 
			FILE_APPEND
		);
}