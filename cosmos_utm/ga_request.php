<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$sErrorMessage = '';
$iHitId = 0;
/**
 * @todo сделать компонент обрабатывающий GET/POST параметры и записывающий их в инфоблок хитов. на вход clientId, позиция телефона.
 */
if ( isset( $_REQUEST['clientId'] ) && $_REQUEST['clientId'] ) {

    $cidGA = trim( $_REQUEST['clientId'] );
    $oCosmosHit = new Cosmos_UTM_Hit;

    try {
        $oChannel = new Cosmos_UTM_Channel();
        $oParam = Cosmos_UTM_Param::getInstance();
	$iChannelID = $oChannel->getIdByUserCondition();
        $iHitId = $oCosmosHit->set( $iChannelID, $cidGA );
        $oParam->set( 'flag_cidga_' . $iChannelID, 'Y', time() + 60*60*24*365 );
    } catch ( Cosmos_Exception $e ) {
        $sErrorMessage = $e->getMessage();
    }
}
echo json_encode( array( 'status' => $iHitId ? 0 : 1, 'message' => $sErrorMessage ) );
