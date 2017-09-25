<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$aCosmosConfigAtsParam = Cosmos_Config::getInstance()->getParam( 'cosmos_utm_ats' );

$oAts = Cosmos_UTM_ATS_Factory::getAts($aCosmosConfigAtsParam['name']);

$sCallerPhone = $oAts->getCallerPhone();// номер с которого позвонили
$sCalledPhone = $oAts->getCalledPhone();// номер на который позвонили

$oAts->process( $sCallerPhone, $sCalledPhone );

echo json_encode( array( 'status' => $oAts->getStatus(), 'message' => $oAts->getErrorMessage() ) );