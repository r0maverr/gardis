<?php

header('Content-type: application/json; charset=cp1251');
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->RestartBuffer();

$_REQUEST = $APPLICATION->ConvertCharsetArray($_REQUEST, 'utf-8', SITE_CHARSET);

$json = array(
    'error' => 'ok',
    'message' => 'unknown',
);

if (CModule::IncludeModule('form')) 
{
    $params = array();
//p($_REQUEST, '_REQUEST',1);
    if (isset($_REQUEST['WEB_FORM_ID']) && intval($_REQUEST['WEB_FORM_ID']) > 0) {

        $params['arrVALUES'] = $_REQUEST;
        // check errors
        $params['FORM_ERRORS'] = \CForm::Check($_REQUEST['WEB_FORM_ID'], $params['arrVALUES'], false, 'N', 'N');
//p($params, 'params',1);
        if (strlen($params['FORM_ERRORS']))
        {
            $json = array(
                'error' => 'ok',
                'messages' => $params['FORM_ERRORS'],
            );
        } 
        else 
        {
            // check user session
            if (check_bitrix_sessid()) 
            {
                // add result
                if ($resultId = \CFormResult::Add($_REQUEST['WEB_FORM_ID'], $params['arrVALUES'])) {
                    $successText = 'Информация принята';
                    $dateH = date("H")+4;

                    if( $dateH > 17 || $dateH < 9){
                        $successText = 'Спасибо за заявку, мы перезвоним Вам в ближайшее время!';
                    }else{
                        $successText = 'Спасибо за заявку, мы перезвоним Вам в течение 15 минут!';
                    }
                    $rsForm = CForm::GetByID($_REQUEST['WEB_FORM_ID']);
                    $arForm = $rsForm->Fetch();
                    if($arForm['DESCRIPTION'])
                        $successText = $arForm['DESCRIPTION'];
                    $json = array(
                        'success' => 'ok',
                        'messages' => $successText,
                        'result_id' => $resultId,
                    );

                    // send email notifications
                    //\CFormCRM::onResultAdded($_POST['WEB_FORM_ID'], $resultId);
                    //\CFormResult::SetEvent($resultId);
                    \CFormResult::Mail($resultId);
                }
                else{
                    global $strError;
                    echo $strError;
                }
            } 
            else 
            {
                $json = array(
                    'error' => 'ok',
                    'messages' =>  'Ошибка. Обновите страницу и попробуйте ещё раз.',
                );
            }
        }
    }
}
//p($json, 'json');
$json['messages'] = $APPLICATION->ConvertCharset($json['messages'], SITE_CHARSET, 'utf-8');
//Возвращаем результат
echo json_encode($json);

die();