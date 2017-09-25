<?
use \Bitrix\Main\Loader;
use \Bitrix\Sale\DiscountCouponsManager;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-type: application/json; charset=cp1251');
//header('Content-type: application/json; charset=utf-8');
//require(dirname(__FILE__)."/lang/" . LANGUAGE_ID . "/script.php");

//$_POST['ORDER_PROPS']['NAME'] = $APPLICATION->ConvertCharset($_POST['ORDER_PROPS']['NAME'], 'utf-8', SITE_CHARSET);
$_POST = $APPLICATION->ConvertCharsetArray($_POST, 'utf-8', SITE_CHARSET);

//p($_POST,'_POST',1);



ob_start();

if(!function_exists('json_encode')){
    function json_encode($value){
        if(is_int($value)){
			return (string)$value;
		}
		elseif(is_string($value)){
	        $value = str_replace(array('\\', '/', '"', "\r", "\n", "\b", "\f", "\t"),  array('\\\\', '\/', '\"', '\r', '\n', '\b', '\f', '\t'), $value);
	        $convmap = array(0x80, 0xFFFF, 0, 0xFFFF);
	        $result = "";
	        for ($i = mb_strlen($value) - 1; $i >= 0; $i--){
	            $mb_char = mb_substr($value, $i, 1);
	            if (mb_ereg("&#(\\d+);", mb_encode_numericentity($mb_char, $convmap, "UTF-8"), $match)) { $result = sprintf("\\u%04x", $match[1]) . $result;  }
				else { $result = $mb_char . $result;  }
	        }
	        return '"' . $result . '"';
        }
		elseif(is_float($value)) { return str_replace(",", ".", $value); }
		elseif(is_null($value)) {  return 'null';}
		elseif(is_bool($value)) { return $value ? 'true' : 'false';   }
		elseif(is_array($value)){
            $with_keys = false;
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value))  { if (key($value) !== $i) {  $with_keys = true; break;  }  }
        }
		elseif (is_object($value)) { $with_keys = true; }
		else { return ''; }
        $result = array();
        if ($with_keys)  {  foreach ($value as $key => $v) {  $result[] = json_encode((string)$key) . ':' . json_encode($v); }  return '{' . implode(',', $result) . '}'; }
		else {  foreach ($value as $key => $v) { $result[] = json_encode($v); } return '[' . implode(',', $result) . ']';  }
    }
}

if(!function_exists('getJson')) {
	function getJson($message, $res='N', $error=''){
		global $APPLICATION;
		$result = array(
			'result' => $res=='Y'?'Y':'N',
			'message' => $APPLICATION->ConvertCharset($message, SITE_CHARSET, 'utf-8')
		);
		if (strlen($error) > 0) { $result['err'] = $APPLICATION->ConvertCharset($error, SITE_CHARSET, 'utf-8'); }
		return json_encode($result);
	}
}

if(!function_exists('AddOrderProperty')) {
    function AddOrderProperty($code, $value, $orderId) {
		if (!strlen($code)) {
			return false;
		}
		if (Loader::includeModule('sale')) 
		{  
			if ($arProp = CSaleOrderProps::GetList(array(), array('CODE' => $code))->Fetch()) 
			{
				$arFilter = Array(
					"ORDER_ID" => $orderId,
					"ORDER_PROPS_ID" => $arProp['ID'],
				);
				$dbP = CSaleOrderPropsValue::GetList(Array(), $arFilter);
				if($arP = $dbP->Fetch())
				{
					return CSaleOrderPropsValue::Update($arP['ID'], array(
					   'NAME' => $arProp['NAME'],
					   'CODE' => $arProp['CODE'],
					   'ORDER_PROPS_ID' => $arProp['ID'],
					   'ORDER_ID' => $orderId,
					   'VALUE' => $value,
					));
				}
				else{
					$arFields = array(
					   'NAME' => $arProp['NAME'],
					   'CODE' => $arProp['CODE'],
					   'ORDER_PROPS_ID' => $arProp['ID'],
					   'ORDER_ID' => $orderId,
					   'VALUE' => $value,
					);
					//return \CSaleOrderPropsValue::Add($arFields);
					\CSaleOrderPropsValue::Add($arFields);
					$arProp = \CSaleOrderPropsValue::GetList(Array(), $arFilter)->Fetch();
				}
			}
		}
    }
}
if(!CModule::IncludeModule('sale') || !CModule::IncludeModule('iblock') || !CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency')){
	die(getJson('модули не установлены'));
}

global $APPLICATION, $USER;
$user_registered = false;
$bAllBasketSave = true; // сохранять товары в корзине после заказа
// $_POST['ORDER_PROPS']['NAME'] = $APPLICATION->ConvertCharset($_POST['ORDER_PROPS']['NAME'], 'utf-8', SITE_CHARSET);
// $_POST['ORDER_PROPS']['COMMENT'] = $APPLICATION->ConvertCharset($_POST['ORDER_PROPS']['COMMENT'], 'utf-8', SITE_CHARSET);

// check input data
//if(!empty($_POST['ORDER_PROPS']['EMAIL']) && !preg_match('/^[0-9a-zA-Z\-_\.]+@[0-9a-zA-Z\-]+[\.]{1}[0-9a-zA-Z\-]+[\.]?[0-9a-zA-Z\-]+$/', $_POST['ORDER_PROPS']['EMAIL'])) 
   // die(getJson('неверный формат email адреса'));
//elseif(empty($_POST['ORDER_PROPS']['PHONE'])) 
    //die(getJson('не заполнен телефон'));
//elseif(empty($_POST['ORDER_PROPS']['NAME'])) 
  //  die(getJson('не заполнено имя'));

if(!$_POST['ORDER_PROPS']['NAME']){
	$_POST['ORDER_PROPS']['NAME'] = 'Не заполенено';
} 
elseif($_POST['ORDER_PROPS']['NAME'] == 'тест' ||  $_POST['ORDER_PROPS']['NAME'] == 'Тест'){
    $_POST['ORDER_PROPS']['NAME'] = 'test';
}
  
$basketUserID = CSaleBasket::GetBasketUserID();
/*$arBasketItemsAll=array();

// сохраним товары в корзине, отложим их и добавми снова -- пока так не делаем
if($bAllBasketSave){
	$resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array('FUSER_ID' => $basketUserID, 'LID' => SITE_ID, 'ORDER_ID' => NULL, 'DELAY' => 'N'), false, false, array('ID', 'QUANTITY', 'PRODUCT_ID', 'TYPE', 'SET_PARENT_ID'));
	while($arBasketItem = $resBasketItems->Fetch()){
		// get props
		$arProps = array();
		$dbRes = CSaleBasket::GetPropsList(array(), array('BASKET_ID' => $arBasketItem['ID']));
		while($arProp = $dbRes->Fetch()){
		   $arProps[] = $arProp;
		}
		if($arProps){
			$arBasketItem["BASKET_PROPS"]=$arProps;
		}
		$arBasketItemsAll[]=$arBasketItem;
	}
}*/

// register user if not registered
if(!$USER->IsAuthorized()){
	if(!isset($_POST['ORDER_PROPS']['EMAIL']) || trim($_POST['ORDER_PROPS']['EMAIL']) == ''){
		//$login = 'user_' . substr((microtime(true) * 10000), 0, 12);
		$login = 'manager_calculator';
		if (strlen(SITE_SERVER_NAME)) { $server_name = SITE_SERVER_NAME; } else { $server_name = $_SERVER["SERVER_NAME"];}
		$server_name = Cutil::translit($server_name, "ru");
		if($dotPos = strrpos($server_name, "_")){
			$server_name = substr($server_name, 0, $dotPos).str_replace("_", ".", substr($server_name, $dotPos));
		}
		else{
			$server_name .= ".ru";
		}
		$_POST['ORDER_PROPS']['EMAIL'] = $login.'@'.$server_name;
        
        $dbUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => trim($_POST['ORDER_PROPS']['EMAIL'])));
		if($dbUser->SelectedRowsCount() == 0){
			$user_registered = true;
		}
		elseif($dbUser->SelectedRowsCount() == 1){
			$ar_user = $dbUser->Fetch();
			$registeredUserID = $ar_user['ID'];
            $user_registered = false;
		}
	}
	else{
		$dbUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => trim($_POST['ORDER_PROPS']['EMAIL'])));
		if($dbUser->SelectedRowsCount() == 0){
			$login = 'user_'.substr((microtime(true) * 10000), 0, 12);
			$user_registered = true;
		}
		elseif($dbUser->SelectedRowsCount() == 1){
			$ar_user = $dbUser->Fetch();
			$registeredUserID = $ar_user['ID'];
		}
		else die(getJson('Найдено более 1 пользователя с указанным email.'));
	}

	if($user_registered){
		$captcha = COption::GetOptionString('main', 'captcha_registration', 'N');
		if($captcha == 'Y'){COption::SetOptionString('main', 'captcha_registration', 'N');}
		$userPassword = randString(10);
		$username = explode(' ', trim($_POST['ORDER_PROPS']['NAME']));
		$newUser = $USER->Register($login, $username[0], $username[1], $userPassword,  $userPassword, $_POST['ORDER_PROPS']['EMAIL']);
		// $newUser = $USER->Add(array("LOGIN"=>$login, "NAME"=>$username[0], "LAST_NAME"=>$username[1], "PASSWORD"=>$userPassword,  "CONFIRM_PASSWORD"=>$userPassword, "EMAIL"=>$_POST['ORDER_PROPS']['EMAIL']));
		
		if($captcha == 'Y'){
			COption::SetOptionString('main', 'captcha_registration', 'Y');
		}
		if($newUser['TYPE'] == 'ERROR') {
			die(getJson('Ошибка регистрации пользователя.', 'N', $newUser['MESSAGE']));
		}
		else{
			$registeredUserID = $newUser['ID'];
			// $registeredUserID = $newUser;
			if (!empty($_POST['ORDER_PROPS']['PHONE']) && ($arParams["AUTO_LOGOUT"]=="Y")) {
				$USER->Update($registeredUserID,  array('PERSONAL_PHONE' => $_POST['ORDER_PROPS']['PHONE']));
			}
			// $USER->Logout();
		}
	}
}
else{
	$registeredUserID = $USER->GetID();
}

if(!$_POST['ORDER_PROPS']['EMAIL']){
	$_POST['ORDER_PROPS']['EMAIL'] = 'amir-bayazitov@mail.ru';/*$USER->GetEmail();*/
}

// if(!$_POST['ORDER_PROPS']['LOCATION']){
	// $arLocation = CSaleOrderProps::GetList(array("SORT" => "ASC"), array("PERSON_TYPE_ID" => intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1, "CODE" => "LOCATION"), false, false, array())->Fetch();
   	// $_POST['ORDER_PROPS']['LOCATION'] = $arLocation["DEFAULT_VALUE"];
// }

$deliveryId = intval($_POST['DELIVERY_ID']) > 0 ? intval($_POST['DELIVERY_ID']) : "1";
if(class_exists('\Bitrix\Sale\Delivery\Services\Table')){
	$deliveryId = intval($deliveryId) > 0 ? \Bitrix\Sale\Delivery\Services\Table::getCodeById($deliveryId) : "";
}
$isOrderConverted = \Bitrix\Main\Config\Option::get("main", "~sale_converted_15", 'N');

/* New discount */
DiscountCouponsManager::init();

$newOrder = array(
	'LID' => SITE_ID,
	'PAYED' => 'N',
	"CANCELED" => "N",
	"STATUS_ID" => "N",
	'USER_ID' => $registeredUserID,
	'PERSON_TYPE_ID' => intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID'] : 1,
	'DELIVERY_ID' => $deliveryId,
	'PAY_SYSTEM_ID' => intval($_POST['PAY_SYSTEM_ID']) > 0 ? $_POST['PAY_SYSTEM_ID'] : 2,
	'USER_DESCRIPTION' => $_POST['ORDER_PROPS']['COMMENT'],
	'COMMENTS' => 'Заказ из калькулятора. '.$_POST['ORDER_PROPS']['COMMENT_COLOR'].'. '.$_POST['ORDER_PROPS']['COMMENT'],
);

$arProps = array();
$arElements = explode(';',$_POST['ELEMENTS']);
$iblockID = CATALOG_1C_IBLOCK_ID;

$arBasketItems = array();
//p($arElements, 'arElements');
foreach($arElements as $strElement)
{
//p($strElement, 'strElement');   
    if(!$strElement)
        continue;
//getJson('элемент- '.$strElement);
    $arEl = explode(':', $strElement);
//p($arEl, 'arEl'); 

    $productQuantity = (int)$arEl[1];
    $productID = (int)$arEl[0];
    $resProduct = CIBlockElement::GetByID($productID);
	$arProduct = $resProduct->GetNext();
//p($arProduct, 'arProduct');
    if($productQuantity == 0){
        die(getJson('не указано количестов товара '.$arProduct['NAME'], 'N', $strError));
    }
    if($productID == 0){
        die(getJson('не указан ИД товара '.$arProduct['NAME'], 'N', $strError));
    }

    // if this product is already in basket, then fix quantity
    $arBasketItem = CSaleBasket::GetList(array(), array("PRODUCT_ID" => $productID, "FUSER_ID" => $basketUserID, "LID" => SITE_ID, "ORDER_ID" => NULL), false, false, array("ID"))->Fetch();
    if($arBasketItem){
        $productBasketID = $arBasketItem['ID'];
        $arFields = array("DELAY" => "N", "SUBSCRIBE" => "N", "QUANTITY" => $productQuantity);
        CSaleBasket::Update($productBasketID, $arFields);
    }
    else{
p($productID, 'productID');
p($productQuantity, 'productQuantity');
        // add product to basket
        $productBasketID = Add2BasketByProductID($productID, $productQuantity, array()/*, $arProps*/);
        if(!$productBasketID){
            $strError = '';
            if($ex = $APPLICATION->GetException()) {$strError = $ex->GetString();}
//p($strError, 'strError');
            die(getJson('Ошибка добавления товара в корзину: '.$arProduct['NAME'], 'N', $strError));
        }
    }
    
    $arBasketItems[] = CSaleBasket::GetByID($productBasketID);

}
p($arBasketItems, 'arBasketItems');
// update basket items prices
CSaleBasket::UpdateBasketPrices($basketUserID, SITE_ID);
// p($arBasketItems,'arBasketItems');
// p($newOrder['PERSON_TYPE_ID'],'PERSON_TYPE_ID');
// p($newOrder['PAY_SYSTEM_ID'],'PAY_SYSTEM_ID');
// p($deliveryId,'deliveryId');
// p($registeredUserID,'registeredUserID');
// p($_POST,'_POST');
// calculate order prices
$arOrderDat = CSaleOrder::DoCalculateOrder(SITE_ID, $registeredUserID, $arBasketItems, $newOrder['PERSON_TYPE_ID'], array(), $deliveryId, $newOrder['PAY_SYSTEM_ID'], array(), $arErrors, $arWarnings);
//p($arOrderDat,'arOrderDat 1');
if($arErrors){
    die(getJson('Ошибка создания заказа.', 'N', implode('<br>', (array)$arErrors)));
}

// set delivery price to 0
$newOrder["PRICE_DELIVERY"] = $arOrderDat["DELIVERY_PRICE"] = $arOrderDat["PRICE_DELIVERY"] = 0;

$newOrder['CURRENCY'] = $arOrderDat["CURRENCY"];
$newOrder['PRICE'] = $arOrderDat["PRICE"] = $arOrderDat["ORDER_PRICE"] + $arOrderDat["DELIVERY_PRICE"] + $arOrderDat["TAX_PRICE"] - $arOrderDat["DISCOUNT_PRICE"];
$newOrder["DISCOUNT_VALUE"] = $arOrderDat["DISCOUNT_PRICE"];
$newOrder["TAX_VALUE"] = $arOrderDat["bUsingVat"] == "Y" ? $arOrderDat["VAT_SUM"] : $arOrderDat["TAX_PRICE"];
$arOrderDat['USER_ID'] = $registeredUserID;
// create order
// p($_POST, '_POST');
// p($arOrderDat, 'arOrderDat 1');
// p($newOrder, 'newOrder');
// p($arErrors, 'arErrors');
$orderID = $arResult['ORDER_ID'] = (int)CSaleOrder::DoSaveOrder($arOrderDat, $newOrder, 0, $arErrors);
if($orderID == false){
    $strError = '';
    if($ex = $APPLICATION->GetException()) $strError = $ex->GetString();
    die(getJson('Ошибка создания заказа.', 'N', $strError));
}
if($orderID){
    // add product to order
    
    
   // foreach($arBasketItems as $arBasketItem)
    //    CSaleBasket::Update($arBasketItem['ID'], array('ORDER_ID' => $orderID));
        
        
        
    // if latest sale version with converted module sale, than check items
    // $resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array(/*'FUSER_ID' => $basketUserID,*/ 'LID' => SITE_ID, 'ORDER_ID' => $orderID), false, false, array('ID', 'QUANTITY', 'PRODUCT_ID', 'TYPE', 'SET_PARENT_ID'));
    // while($arBasketItem = $resBasketItems->Fetch()){
        // if($arBasketItem['ID'] == $productBasketID){
            // $product_id=$arBasketItem['PRODUCT_ID'];
        // }
        // if($arBasketItem['ID'] != $productBasketID){
            // $bSetItem = CSaleBasketHelper::isSetItem($arBasketItem);
            // if($bSetItem && $arBasketItem['SET_PARENT_ID'] == $productBasketID) // set item
                // continue;

            // // get props
            // $arProps = array();
            // $dbRes = CSaleBasket::GetPropsList(array(), array('BASKET_ID' => $arBasketItem['ID']));
            // while($arProp = $dbRes->Fetch()){
               // $arProps[] = $arProp;
            // }

            // // delete from order
            // CSaleBasket::Delete($arBasketItem['ID']);

            // // add to basket again
            // if(!$bSetItem  && $product_id!=$arBasketItem['PRODUCT_ID'] && !$user_registered){
                // Add2BasketByProductID($arBasketItem['PRODUCT_ID'], $arBasketItem['QUANTITY'], array(), $arProps);
            // }
        // }
        
    // }
    

    // fix bug with DELIVERY_PRICE, when count of products more than one (bitrix bug with delivery price)
    $arUpdateFields = array('PRICE' => $newOrder['PRICE'], 'PRICE_DELIVERY' => 0);
    if(class_exists('\Bitrix\Sale\Internals\OrderTable')){
        \Bitrix\Sale\Internals\OrderTable::update($orderID, $arUpdateFields);

        // fix bug with payment SUM, when buy set
        if(class_exists('\Bitrix\Sale\Internals\PaymentTable')){
            $res = \Bitrix\Sale\Internals\PaymentTable::getList(array('order' => array('ID' => 'ASC'), 'filter' => array('ORDER_ID' => $orderID)));
            if($payment = $res->fetch()){
                \Bitrix\Sale\Internals\PaymentTable::update($payment['ID'], array('SUM' => $newOrder['PRICE']));
            }
        }
    }
    else{
        CSaleOrder::Update($orderID, $arUpdateFields);
    }

}


/*if($user_registered){
	$USER->Logout();
	if(!$USER->IsAuthorized() && $arBasketItemsAll){
		foreach($arBasketItemsAll as $arItem){
			// get props
			$arProps = array();
			if($arItem['BASKET_PROPS']){
				$arProps=$arItem['BASKET_PROPS'];
			}
			Add2BasketByProductID($arItem['PRODUCT_ID'], $arItem['QUANTITY'], array(), $arProps);
		}
	}
}*/

// add order properties
//$res = CSaleOrderProps::GetList(array(), array('@CODE' => unserialize($_POST["PROPERTIES"]))); 
$personType = intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1;
$res = CSaleOrderProps::GetList(array(), array('PERSON_TYPE_ID'=>$personType/*'@CODE' => array('NAME','PHONE')*/)); 
while($prop = $res->Fetch()){
//p($prop, 'prop');  
    
	if($_POST['ORDER_PROPS'][$prop['CODE']] /*&& ($prop['PERSON_TYPE_ID'] == $personType)*/){
		//CSaleOrderPropsValue::Add(array('ORDER_ID' => $orderID, 'NAME' => $prop['NAME'], 'ORDER_PROPS_ID' => $prop['ID'], 'CODE' => $prop['CODE'], 'VALUE' => $_POST['ORDER_PROPS'][$prop['CODE']]));
        AddOrderProperty($prop['CODE'], $_POST['ORDER_PROPS'][$prop['CODE']], $orderID);
	}
}
//p($personType, 'personType',1);
// send mail
if($orderID){
	$orderPrice = 0;
	$orderList = '';
	$arCurrency = CCurrencyLang::GetByID($newOrder['CURRENCY'], LANGUAGE_ID);
	$currencyThousandsSep = (!$arCurrency["THOUSANDS_VARIANT"] ? $arCurrency["THOUSANDS_SEP"] : ($arCurrency["THOUSANDS_VARIANT"] == "S" ? " " : ($arCurrency["THOUSANDS_VARIANT"] == "D" ? "." : ($arCurrency["THOUSANDS_VARIANT"] == "C" ? "," : ($arCurrency["THOUSANDS_VARIANT"] == "B" ? "\xA0" : "")))));

	$arSelFields = array("ID", "PRODUCT_ID", "QUANTITY", "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "DISCOUNT_PRICE", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL");
	$resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array('FUSER_ID' => $basketUserID, 'LID' => SITE_ID, 'ORDER_ID' => $orderID), false, false, $arSelFields);
	while($arBasketItem = $resBasketItems->Fetch()){
		if(CSaleBasketHelper::isSetItem($arBasketItem)) // set item
			continue;

		if($arBasketItem['CAN_BUY'] === 'Y'){
			$curPrice = roundEx($arBasketItem['PRICE'], SALE_VALUE_PRECISION) * DoubleVal($arBasketItem['QUANTITY']);
			$orderPrice += $curPrice;
			$orderList .= 'Название: ' . $arBasketItem['NAME']
				. ', цена за единицу: ' . str_replace('#', number_format($arBasketItem['PRICE'], $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING'])
				. ', количество: ' . intval($arBasketItem['QUANTITY'])
				. ', стоимость: ' . str_replace('#', number_format($curPrice, $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING']) . "\n";
		}
	}

	$arMessageFields = array(
		"RS_ORDER_ID" => $orderID,
		"ORDER_USER" => $_POST['ORDER_PROPS']['NAME'],
		"EMAIL" => $_POST["ORDER_PROPS"]["EMAIL"],
		"PHONE" => $_POST["ORDER_PROPS"]["PHONE"],
		"ORDER_LIST" => $orderList,
		"PRICE" => str_replace('#', number_format($orderPrice, $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING']),
		"COMMENT" => $_POST['ORDER_PROPS']['COMMENT'],
		"RS_DATE_CREATE" => ConvertTimeStamp(false, "FULL"),
	);

	CEvent::Send("SALE_NEW_ORDER", SITE_ID, $arMessageFields);
}

$_SESSION['SALE_BASKET_NUM_PRODUCTS'][SITE_ID] = 0;

/*bind sale events*/
foreach(GetModuleEvents("sale", "OnSaleComponentOrderOneStepComplete", true) as $arEvent)
	ExecuteModuleEventEx($arEvent, Array($orderID, $arOrder, $arParams));

ob_clean();

die(getJson('Номер Вашего заказа: '.$orderID, 'Y'));
?>