<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
  // антиспам проверка, смысл в том чтобы у робота не работал js
  if (!isset($_POST['controll']) || $_POST['controll'] != 'yes') {
    LocalRedirect($APPLICATION->GetCurPageParam('', array("success")));
  }
  
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			/* if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");		
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
*/			
			$_POST["user_phone"] = preg_replace('/ +/', '', $_POST['user_phone']);
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_phone"]) <= 1) {
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_PHONE");
			} elseif(!preg_match('/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', $_POST["user_phone"])) {
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_INVALID_PHONE");
			}
/*				
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("COMPANY", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_company"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_COMPANY");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("ADRESS", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_adress"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_ADRESS");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["MESSAGE"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
				*/
		}
		/*
		if(strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}			
		*/

		if(empty($arResult["ERROR_MESSAGE"]))
		{

			//Обработка источника
			$referer = "";
			$arRef = CMyUTM::GetSource();
			if(!empty($arRef))
				foreach($arRef as $k => $v)
					$referer .= $k.": ".$v."\n";

			$arFields = Array(
				"AUTHOR" => $_POST["user_name"],
				"PHONE" => $_POST["user_phone"],
				"COMPANY" => $_POST["user_company"],
				"ADRESS" => $_POST["user_adress"],
				"AUTHOR_EMAIL" => $_POST["user_email"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST["MESSAGE"],
//				"SUBJECT_PREFIX" => ((isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone'])) ? 'Директ_' : 'Сео_')
				"SUBJECT_PREFIX" => (isset($arRef['clid'])) ? $arRef['clid'] : 'Сео',
				"REFERER" => $referer
			);
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsEx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsEx($_POST["user_email"]);
			
			//добавление заявки в инфоблок
			$el = new CIBlockElement;
			$arProp = array();
			$arProp["PHONE"] = $_POST["user_phone"];
			// $arProp["AUTHOR_EMAIL"] = $_POST["user_email"];
			// $arProp["COMPANY"] = $_POST["user_company"];
			// $arProp["ADRESS"] = $_POST["user_adress"];
			$arProp["TYPE"] = 2; //заказ звонка
			$arLoadProductArray = Array(  
				"IBLOCK_ID"      => 26,
				// "NAME"           => $_POST["user_name"]." - ".$_POST["user_email"],
				"ACTIVE"         => "Y",
				// "DETAIL_TEXT"    => $_POST["MESSAGE"],
				"PROPERTY_VALUES"=> $arProp,
			);
			$go = $el->Add($arLoadProductArray);
			
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}
		
		//$arResult["MESSAGE"] = htmlspecialcharsEx($_POST["MESSAGE"]);
		// $arResult["AUTHOR_NAME"] = htmlspecialcharsEx($_POST["user_name"]);
		$arResult["AUTHOR_PHONE"] = htmlspecialcharsEx($_POST["user_phone"]);
		// $arResult["AUTHOR_COMPANY"] = htmlspecialcharsEx($_POST["user_company"]);
		// $arResult["AUTHOR_ADRESS"] = htmlspecialcharsEx($_POST["user_adress"]);
		// $arResult["AUTHOR_EMAIL"] = htmlspecialcharsEx($_POST["user_email"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = htmlspecialcharsEx($USER->GetFormattedName(false));
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsEx($USER->GetEmail());
	}
	else
	{
		if(strlen($_SESSION["MF_NAME"]) > 0)
			$arResult["AUTHOR_NAME"] = htmlspecialcharsEx($_SESSION["MF_NAME"]);
		if(strlen($_SESSION["MF_EMAIL"]) > 0)
			$arResult["AUTHOR_EMAIL"] = htmlspecialcharsEx($_SESSION["MF_EMAIL"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
?>