<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");

//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.min.css");
?>

<?
// Загрузка модулей Битрикса
if (!Bitrix\Main\Loader::includeModule('iblock') or !Bitrix\Main\Loader::includeModule('catalog'))
{
    die ('Ошибка в загрузки модулей...');
}

$arParamsTranslit = array("replace_space"=>"_","replace_other"=>"_");

$arType = array( //Тип панели:  fit, light, optima, medium2d, Estetic, power, industrial
        'F' => 'Fit',
        'L' => 'Light',
        'О' => 'Optima',
        'P' => 'Power',
        'I' => 'Industrial',
        'М' => 'Medium 2D',
        'Е' => 'Estetic',
        //'H' => 'H',
        
    );
    
//$el = new CIBlockElement;
$idIBlock = CATALOG_1C_IBLOCK_ID;
$arFilter = array(
    'IBLOCK_ID' => $idIBlock,  
    //'SECTION_CODE' => 'paneli_ograzhdeniya',   
    'INCLUDE_SUBSECTIONS' => 'Y',   
    'ACTIVE' => 'Y',   
);

$arVid = $arPokritie = $arWidth = $arHeight = $arYacheika = $arDiametr = $arVidDiametr = array();

$obCache = new \CPHPCache();
$cacheLifeTime = 86400*60;
$cacheID = 'iblock_id_'.$idIBlock;
$cacheDir = 's1/calculator';

if($obCache->InitCache($cacheLifeTime, $cacheID, $cacheDir) ) 
{
    $returnRes = $obCache->GetVars();		
}
elseif($obCache->StartDataCache())
{
    if (defined('BX_COMP_MANAGED_CACHE')) {

        $tagCache = new Bitrix\Main\Data\TaggedCache();
        $tagCache->startTagCache($cacheDir);
        $tagCache->registerTag(sprintf('iblock_id_%s', $idIBlock));
        $tagCache->endTagCache();
    }
    
    // дерева подразделов для раздела 
/*$rsParentSection = CIBlockSection::GetByID(1429);
    if ($arParentSection = $rsParentSection->GetNext())
    {
    $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
    while ($arSect = $rsSect->GetNext())
    {
       // получаем подразделы
    }
}*/

    //$dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, /*'DEPTH_LEVEL' => 2, 'CODE' => 'paneli_ograzhdeniya'*/'SECTION_ID'=>1429 ), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    //while($arSection = $dbRes->Fetch())
    //{
     
    $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, /*'DEPTH_LEVEL' => 2,*/ 'CODE' => 'paneli_ograzhdeniya_s_shagom_55'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    if($arSection = $dbRes->Fetch()) {   
//echo $arSection['NAME'].'<br>';
        $arFilter['SECTION_CODE'] = $arSection['CODE'];
       
        //Панели ограждения
        //if($arSection['CODE'] == 'paneli_ograzhdeniya' || $arSection['CODE'] == 'paneli_ograzhdeniya_s_shagom_55') 
        //{
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_TYPE', 'PROPERTY_POKRITIE', 'PROPERTY_HEIGHT', 'PROPERTY_VID', 'PROPERTY_WIDTH', 'PROPERTY_YACHEYKA', 'PROPERTY_DIAMETR', 'PROPERTY_VID_DIAMETR');
            
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
    //p($arEl,'arEl');
    // p($arEl['NAME'],'NAME');
    // p($arEl['PROPERTY_TYPE_VALUE'],'PROPERTY_TYPE_VALUE');
    //пропускаем 2300
    if($arEl['PROPERTY_HEIGHT_VALUE'] == 2300)
        continue;
                $returnRes['PANELI']['TYPE'][$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                //$returnRes['PANELI']['VID'] = $arVid[$arEl['PROPERTY_VID_VALUE']] = $arEl['PROPERTY_VID_VALUE'];
                //$returnRes['PANELI']['POKRITIE'] = $arPokritie[$arEl['PROPERTY_POKRITIE_VALUE']] = $arEl['PROPERTY_POKRITIE_VALUE'];
                $returnRes['PANELI']['WIDTH'][$arEl['PROPERTY_WIDTH_VALUE']] = $arEl['PROPERTY_WIDTH_VALUE'];
                $returnRes['PANELI']['HEIGHT'][$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];
                $returnRes['PANELI']['YACHEYKA'][$arEl['PROPERTY_YACHEYKA_VALUE']] = $arEl['PROPERTY_YACHEYKA_VALUE'];
                $returnRes['PANELI']['DIAMETR'][$arEl['PROPERTY_DIAMETR_VALUE']] = $arEl['PROPERTY_DIAMETR_VALUE'];
                //$returnRes['PANELI']['VID_DIAMETR'][$arEl['PROPERTY_VID_DIAMETR_VALUE']]  = $arEl['PROPERTY_VID_DIAMETR_VALUE'];
                
                $returnRes['PANELI']['HIGHT_TYPE'][$arEl['PROPERTY_HEIGHT_VALUE']][$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                $returnRes['PANELI']['TYPE_HEIGHT'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];
                $returnRes['PANELI']['TYPE_HEIGHT_WIDTH'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_HEIGHT_VALUE']][$arEl['PROPERTY_WIDTH_VALUE']] = true;
            }
            
            asort($returnRes['PANELI']['WIDTH']);
            asort($returnRes['PANELI']['HEIGHT']);
            asort($returnRes['PANELI']['YACHEYKA']);
            asort($returnRes['PANELI']['DIAMETR']);
    // p($arSection,'arSection');  
        //}
        
    } 
    
    $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'CODE' => 'stolby_ograzhdeniya_gardis_s_07_2014'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    if($arSection = $dbRes->Fetch()) {     
        //elseif($arSection['CODE'] == 'stolby_ograzhdeniya_gardis_s_07_2014')// столбы
        //{  
            $arFilter['SECTION_CODE'] = $arSection['CODE'];
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_SECHENIE', 'PROPERTY_TYPE_INSTALL', 'PROPERTY_POKRITIE', 'PROPERTY_HEIGHT');
            $getQuery = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                 
            if ($getQuery->SelectedRowsCount() > 0)
            {

                $arSechenieStolba = $arTypeInstallStolba = $arPokritieStolba = $arHeightStolba = array();
                while ($arEl = $getQuery->GetNext())
                {
              //p($arEl);
//print_r($arEl['PROPERTY_TYPE_INSTALL_VALUE']);
                    $returnRes['STOLBI']['SECHENIE'][$arEl['PROPERTY_SECHENIE_VALUE']] = $arEl['PROPERTY_SECHENIE_VALUE'];
                    $returnRes['STOLBI']['POKRITIE'][$arEl['PROPERTY_POKRITIE_VALUE']] = $arEl['PROPERTY_POKRITIE_VALUE'];
                    $returnRes['STOLBI']['HEIGHT'][$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];  

                    if($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'под бетонирование')
                        $returnRes['STOLBI']['TYPE_INSTALL'][100] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    elseif($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'на фланцах')
                        $returnRes['STOLBI']['TYPE_INSTALL'][200] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    elseif($arEl['PROPERTY_TYPE_INSTALL_VALUE'])
                        $returnRes['STOLBI']['TYPE_INSTALL'][300] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];
                        
                    $returnRes['STOLBI']['DLINA_TYPE_INSTALL'][$arEl['PROPERTY_HEIGHT_VALUE']][$arEl['PROPERTY_SECHENIE_VALUE']][$arEl['PROPERTY_TYPE_INSTALL_VALUE']] = $arEl['PROPERTY_TYPE_INSTALL_VALUE']; 
                    preg_match('/([\d]+\*[\d]+)/', $arEl['PROPERTY_SECHENIE_VALUE'], $match);
                    $returnRes['STOLBI']['SECHENIE_HEIGHT'][$match[1]][$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];  
                }
//print_r($returnRes['STOLBI']['TYPE_INSTALL']);
                ksort($returnRes['STOLBI']['TYPE_INSTALL']);
                asort($returnRes['STOLBI']['SECHENIE']);
                asort($returnRes['STOLBI']['POKRITIE']);
                asort($returnRes['STOLBI']['HEIGHT']);
            }  
        //} 
    }  
// входные группы
    $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'CODE' => 'vkhodnye_gruppy'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    if($arSection = $dbRes->Fetch()) 
    {     

        $arTypeKalitka = $arZapolnKalitka = $arOtkrivanieKalitka = $arTypeInstallKalitka = $arWidthKalitka = $arHeightKalitka = array();
        $dbResS = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'SECTION_ID' => $arSection['ID'] ), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
        while($arSectionThree = $dbResS->Fetch())
        {
            
            if($arSectionThree['CODE'] == 'vorota_raspashnye')
            {
                $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_WIDTH', 'PROPERTY_HEIGHT', 'PROPERTY_TYPE', 'PROPERTY_VID', 'PROPERTY_OTKRIVANIE', 'PROPERTY_TYPE_INSTALL');
                $arFilter['SECTION_CODE'] = $arSectionThree['CODE'];          
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                $arTypeVorot = $arZapolnVorot = $arOtkrivanieVorot = $arTypeInstallVorot = $arWidthVorot = $arHeightVorot = array();
    //p($arSectionThree,'arSectionThree');             
                while ($arEl = $res->GetNext())
                {
    //p($arEl['NAME'], 'NAME');
                    //$returnRes['VOROTA']['TYPE'][$arEl['PROPERTY_TYPE_VALUE']] = $arTypeVorot[$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                    //$returnRes['VOROTA']['VID'][$arEl['PROPERTY_VID_VALUE']] = $arZapolnVorot[$arEl['PROPERTY_VID_VALUE']] = $arEl['PROPERTY_VID_VALUE'];
                    $returnRes['VOROTA']['OTKRIVANIE'][$arEl['PROPERTY_OTKRIVANIE_VALUE']] = $arOtkrivanieVorot[$arEl['PROPERTY_OTKRIVANIE_VALUE']] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];
                    if($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'под бетонирование')
                        $returnRes['VOROTA']['TYPE_INSTALL'][100] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    elseif($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'на фланцах')
                        $returnRes['VOROTA']['TYPE_INSTALL'][200] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    else
                        $returnRes['VOROTA']['TYPE_INSTALL'][300] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];
                    $returnRes['VOROTA']['WIDTH'][$arEl['PROPERTY_WIDTH_VALUE']] = $arWidthVorot[$arEl['PROPERTY_WIDTH_VALUE']] = $arEl['PROPERTY_WIDTH_VALUE'];
                    $returnRes['VOROTA']['HEIGHT'][$arEl['PROPERTY_HEIGHT_VALUE']] = $arHeightVorot[$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];
                    
                    if($arEl['PROPERTY_TYPE_VALUE'] == 'F'){
                        $returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['vorota_fit'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ 'внутреннее' ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                        $returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['vorota_fit'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ 'наружное' ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                    }
                    else{
                        $returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['vorota_standart'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ $arEl['PROPERTY_OTKRIVANIE_VALUE'] ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                    }  

                }  

                 asort($returnRes['VOROTA']['OTKRIVANIE']);
                ksort($returnRes['VOROTA']['TYPE_INSTALL']);
                 asort($returnRes['VOROTA']['WIDTH']);
                 asort($returnRes['VOROTA']['HEIGHT']);
                 
            }            
            elseif($arSectionThree['CODE'] == 'kalitki_raspashnye_stolby_pod_betonirovanie' || $arSectionThree['CODE'] == 'kalitki_raspashnye_stolby_s_flantsem')
            {
                $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_WIDTH', 'PROPERTY_HEIGHT', 'PROPERTY_TYPE', 'PROPERTY_VID', 'PROPERTY_OTKRIVANIE', 'PROPERTY_TYPE_INSTALL');
                $arFilter['SECTION_CODE'] = $arSectionThree['CODE'];          
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                
    //p($arSectionThree,'arSectionThree');             
                while ($arEl = $res->GetNext())
                {
    //p($arEl['NAME'], 'NAME');
                    //$arTypeKalitka[$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                    //$arZapolnKalitka[$arEl['PROPERTY_VID_VALUE']] = $arEl['PROPERTY_VID_VALUE'];
                    $returnRes['KALITKA']['OTKRIVANIE'][$arEl['PROPERTY_OTKRIVANIE_VALUE']] = $arOtkrivanieKalitka[$arEl['PROPERTY_OTKRIVANIE_VALUE']] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];
                    
                    if($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'под бетонирование')
                        $returnRes['KALITKA']['TYPE_INSTALL'][100] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    elseif($arEl['PROPERTY_TYPE_INSTALL_VALUE'] == 'на фланцах')
                        $returnRes['KALITKA']['TYPE_INSTALL'][200] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];  
                    else
                        $returnRes['KALITKA']['TYPE_INSTALL'][300] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];
                    
                    $returnRes['KALITKA']['WIDTH'][$arEl['PROPERTY_WIDTH_VALUE']] = $arWidthKalitka[$arEl['PROPERTY_WIDTH_VALUE']] = $arEl['PROPERTY_WIDTH_VALUE'];
                    $returnRes['KALITKA']['HEIGHT'][$arEl['PROPERTY_HEIGHT_VALUE']] = $arHeightKalitka[$arEl['PROPERTY_HEIGHT_VALUE']] = $arEl['PROPERTY_HEIGHT_VALUE'];
                    
                    if($arEl['PROPERTY_TYPE_VALUE'] == 'F'){
                        $returnRes['KALITKA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['kalitka_fit'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ 'левое' ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                        $returnRes['KALITKA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['kalitka_fit'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ 'правое' ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                    }
                    else{
                        $returnRes['KALITKA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['kalitka_standart'][ $arEl['PROPERTY_HEIGHT_VALUE'] ][ $arEl['PROPERTY_WIDTH_VALUE'] ][ $arEl['PROPERTY_OTKRIVANIE_VALUE'] ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
                    }
                    
                }    
                ksort($returnRes['KALITKA']['TYPE_INSTALL']);
                asort($returnRes['KALITKA']['OTKRIVANIE']);
                asort($returnRes['KALITKA']['WIDTH']);
                asort($returnRes['KALITKA']['HEIGHT']);
            }
        }  

        // ворота откатные
        $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'CODE' => 'vorota_otkatnye'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
        if($arSection = $dbRes->Fetch())
        {
            $arFilter['SECTION_CODE'] = $arSection['CODE'];          
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while ($arEl = $res->GetNext())
            {
    //p($arEl['NAME'], 'NAME');
                //$returnRes['VOROTA']['TYPE'][$arEl['PROPERTY_TYPE_VALUE']] = $arTypeVorot[$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                //$returnRes['VOROTA']['VID'][$arEl['PROPERTY_VID_VALUE']] = $arZapolnVorot[$arEl['PROPERTY_VID_VALUE']] = $arEl['PROPERTY_VID_VALUE'];
                if($arEl['PROPERTY_OTKRIVANIE_VALUE'] == 'внутреннее')
                        $returnRes['VOROTA']['OTKRIVANIE'][100] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];  
                    elseif($arEl['PROPERTY_OTKRIVANIE_VALUE'] == 'наружное')
                        $returnRes['VOROTA']['OTKRIVANIE'][200] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];  
                    elseif($arEl['PROPERTY_OTKRIVANIE_VALUE'] == 'левое')
                        $returnRes['VOROTA']['OTKRIVANIE'][300] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];  
                    elseif($arEl['PROPERTY_OTKRIVANIE_VALUE'] == 'правое')
                        $returnRes['VOROTA']['OTKRIVANIE'][400] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];  
                    
                //$returnRes['VOROTA']['OTKRIVANIE'][$arEl['PROPERTY_OTKRIVANIE_VALUE']] = $arEl['PROPERTY_OTKRIVANIE_VALUE'];
                $returnRes['VOROTA']['TYPE_INSTALL'][300] = $arEl['PROPERTY_TYPE_INSTALL_VALUE'];
                $returnRes['VOROTA']['WIDTH'][$arEl['PROPERTY_WIDTH_VALUE']/10] = $arEl['PROPERTY_WIDTH_VALUE']/10;
                $returnRes['VOROTA']['HEIGHT'][$arEl['PROPERTY_HEIGHT_VALUE']/10] = $arEl['PROPERTY_HEIGHT_VALUE']/10;
                

                $returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL']['vorota_otkatnie'][ $arEl['PROPERTY_HEIGHT_VALUE']/10 ][ $arEl['PROPERTY_WIDTH_VALUE']/10 ][ $arEl['PROPERTY_OTKRIVANIE_VALUE'] ][ $arEl['PROPERTY_TYPE_INSTALL_VALUE'] ] = true;
   
            }

            ksort($returnRes['VOROTA']['OTKRIVANIE']);
            ksort($returnRes['VOROTA']['TYPE_INSTALL']);
            asort($returnRes['VOROTA']['WIDTH']);
            asort($returnRes['VOROTA']['HEIGHT']);         
        }  
    }   

    $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'CODE' => 'shtangi_barera_bezopasnosti'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    if($arSection = $dbRes->Fetch()) {         
       // elseif($arSection['CODE'] == 'shtangi_barera_bezopasnosti'){
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_DLINA', 'PROPERTY_TYPE', 'PROPERTY_SECHENIE', 'PROPERTY_USILENNOE');
            $arFilter['SECTION_CODE'] = $arSection['CODE'];          
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
    //p($arSection,'arSection');             
            while ($arEl = $res->GetNext())
            {
    //p($arEl['NAME'], 'NAME');
                $returnRes['STANGI']['TYPE'][$arEl['PROPERTY_TYPE_VALUE']] = $arEl['PROPERTY_TYPE_VALUE'];
                $returnRes['STANGI']['DLINA'][$arEl['PROPERTY_DLINA_VALUE']] = $arEl['PROPERTY_DLINA_VALUE'];
                
                $returnRes['STANGI']['TYPE_DLINA'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_DLINA_VALUE']] = $arEl['PROPERTY_DLINA_VALUE'];

            } 
            asort($returnRes['STANGI']['TYPE']);
            asort($returnRes['STANGI']['DLINA']);
        //}
    //}  
    }
    
    $dbRes = CIBlockSection::GetList(array('sort' => 'asc'), array('IBLOCK_ID' => $idIBlock, 'CODE' => 'spiralnyy_i_ploskiy_barer_bezopasnosti'), false, array('IBLOCK_ID', 'ID', 'NAME', 'CODE'));
    if($arSection = $dbRes->Fetch()) {         
       // elseif($arSection['CODE'] == 'shtangi_barera_bezopasnosti'){
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_TYPE', 'PROPERTY_DIAMETR_YAGOZI', 'PROPERTY_KOL_VITKOV');
            $arFilter['SECTION_CODE'] = $arSection['CODE'];          
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
    //p($arSection,'arSection');             
            while ($arEl = $res->GetNext())
            {
    //p($arEl['NAME'], 'NAME');
                if( strpos($arEl['NAME'], 'барьер безопасности') === false){
                    continue;
                }
                else{
                
                    $returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_DIAMETR_YAGOZI_VALUE']] = $arEl['PROPERTY_DIAMETR_YAGOZI_VALUE'];
                    $returnRes['YAGOZA']['TYPE_KOL_VITKOV'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_KOL_VITKOV_VALUE']] = $arEl['PROPERTY_KOL_VITKOV_VALUE'];
                    
                    $returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI_KOL_VITKOV'][$arEl['PROPERTY_TYPE_VALUE']][$arEl['PROPERTY_DIAMETR_YAGOZI_VALUE']][$arEl['PROPERTY_KOL_VITKOV_VALUE']] = 1;
                }
            } 
            asort($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI']['СББ']);
            asort($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI']['ПББ']);
            asort($returnRes['YAGOZA']['TYPE_KOL_VITKOV']['СББ']);
            asort($returnRes['YAGOZA']['TYPE_KOL_VITKOV']['ПББ']);
        //}
    //}  
    }

   
    $obCache->EndDataCache($returnRes);	

} 
//p($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI_KOL_VITKOV'],'TYPE_DIAMETR_YAGOZI_KOL_VITKOV');
//p($returnRes['PANELI']['TYPE_HEIGHT_WIDTH'],'TYPE_HEIGHT_WIDTH');
//p($returnRes['KALITKA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL'],'HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL');
//p($returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL'],'HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL');
// p($returnRes['STOLBI']['SECHENIE_HEIGHT'],'SECHENIE_HEIGHT');
//p($returnRes['STANGI']['TYPE_DLINA'],'TYPE_DLINA');
//p($returnRes);
//p($returnRes['KALITKA']);
//asort($returnRes['PANELI']['VID_DIAMETR']);


?>

<div class="calculator">
    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" class="calculator-form">

    <div class="errortext"></div>
    <div class="fields-wrap clearfix">
        <div class="input-name">Выберите тип объекта</div>
        <div class="input-wrap">
            <select name="type_ob" size="1" id="type_ob" class="check">
                <option value="" selected="selected"></option>
                <option value="prom">Промышленный объект</option>
                <option value="neft">Нефтегазовый объект</option>
                <option value="aero">Аэропорт/Аэродром</option>
                <option value="sport">Спортплощадка(футбол, волейбол, баскетбол)</option>
                <option value="sport-other">Другой спортивный объект</option>
                <option value="admin-house">Административные жилые здания</option>
                <option value="kottedji">Коттеджи/частные дома</option>
                <option value="detskie">Детские площадки/детские сады, школы</option>
                <option value="parki">Парки, зоны отдыха</option>
                <option value="selhoz">Сельскохозяйственный объект</option>
                <option value="tek">ТЭК, связь</option>
                <option value="azs">Парковки, стоянки, азс</option>
                <option value="zd">Железные дороги</option>
                <option value="magistrali">Автомагистрали</option>
                <option value="vpo">Военно-промышленные объекты</option>
                <option value="other">Другое</option>
            </select> 
        </div>
    </div>
    
    <div id="other_fields" class="">

    <div class="fields-wrap clearfix">
        <div class="input-name">Тип участка</div>
        <div class="input-wrap">
            <input type="hidden" name="perimetr" value="" id="perimetr"  placeholder="периметр">
            <input type="radio" name="type_perimetr" checked id="zamknut" value="zamknut"><label for="zamknut">замкнут</label>
            <input type="radio" name="type_perimetr" id="nezamknut" value="nezamknut"><label for="nezamknut">не замкнут</label>
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Тип панели</div>
        <div class="input-wrap" id="input_wrap_type_panel">
            
            <?

// p($arType,'arType');
// p($returnRes['PANELI']['TYPE'],'TYPE');
            foreach($arType as $key => $val){
                if($returnRes['PANELI']['TYPE'][$key]){
                    //echo '<option value="'.$val.'">'.$val.'</option>';?>
                    <input type="radio" name="type_panel" id="type_<?=$key?>" value="<?=$key?>" data-disabled_type=""><label for="type_<?=$key?>"><?=$val?></label>
                <?}
            }
            ?>
            
        </div>
    </div>
        
    <div class="fields-wrap clearfix">
        <div class="input-name">Введите параметры<br>каждого участка</div>
        <div class="input-wrap storoni">
            <?/*<input class="storona" type="text" name="storona1" id="storona1" placeholder="сторона 1"> м.
            <input class="storona" type="text" name="storona2" id="storona2" placeholder="сторона 2"> м.
            <input class="storona" type="text" name="storona3" id="storona3" placeholder="сторона 3"> м.
            <input class="storona" type="text" name="storona4" id="storona4" placeholder="сторона 4"> м.*/?>
            <div class="wrap-storona">  
                <div class="wrap-params">
                    <div class="name-param">
                        Длина участка
                    </div>
                    <div class="input-param">
                        <input class="storona check" type="text" name="storona1" id="storona1" placeholder="участок 1"> м.
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param"> 
                       Высота ограждения
                    </div>
                    <div class="input-param">
                        <select name="height_paneli1" size="1" id="height_paneli1" class="height-paneli check">
                            <option value="" selected></option>
                            <?
                            //$i=0;
                            foreach($returnRes['PANELI']['HEIGHT'] as $val){
                                if($val && !($val == 430 || $val == 830 || $val == 840)){
                                    //$i==0 ? $sel = ' selected' : $sel = '' ;
                                    $height = ceil($val/100)*100;
                                    echo '<option value="'.$val.'">'.($height/1000) .' ('.$val.')'.'</option>';
                                    $i++;
                                }
                            }
                            ?>
                            <option value="3100">3.1</option>
                            <option value="4100">4.1</option>
                        </select> 
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param">
                        Сечение столба
                    </div>
                    <div class="input-param">
                        <select name="sechenie_stolba1" size="1" id="sechenie_stolba1" class="sechenie-stolba check">
                            <option value=""></option>
                            <?
                            foreach($returnRes['STOLBI']['SECHENIE'] as $val){
                                if($val)
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                            }
                            ?>
                        </select> 
                    </div>
                </div>
            </div>
            <span class="add-input" id="add_storona">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span class="add">добавить (если несколько участков)</span>
            </span>
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Длина панели</div>
        <div class="input-wrap">
            <select name="width" size="1" id="width" class="check">
                <option value=""></option>
                <?
                foreach($returnRes['PANELI']['WIDTH'] as $val){
                    //if($val == 2500 || $val == 3000){
                        $selected = $val == 2500 ? ' selected' : '';
                        echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
                    //}
                }
                ?>
            </select> 
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Столб</div>
        <div class="input-wrap">
            <div class="wrap-line">
                <?
                $i=0;
                foreach($returnRes['STOLBI']['TYPE_INSTALL'] as $val){
                    if($val){ 
                        $val=='под бетонирование' ? $checked = ' checked' : $checked = '';
                        $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                        echo '<input type="radio" name="type_install_stolba" value="'.$val.'" id="stolb_'.$valTranslit.'"'.$checked.'><label for="stolb_'.$valTranslit.'">'.$val.'</label>';
                        $i++;
                    }
                }
                ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="fields-wrap clearfix">
        <div class="input-name">Калитка</div>
        <div class="input-wrap">
        
            <input type="checkbox" name="kalitka" id="kalitka">

            <div class="block-params">
                <div class="wrap-line">
                    <input type="radio" name="type_kalitka" checked id="kalitka_standart" value="kalitka_standart"><label for="kalitka_standart">Стандарт</label>
                    <input type="radio" name="type_kalitka" id="kalitka_fit" value="kalitka_fit"><label for="kalitka_fit">Фит</label>
                </div>
                <div class="clear"></div>
                <div class="wrap-params">
                    <div class="name-param">
                        Количество
                    </div>
                    <div class="input-param">
                        <input type="text" name="kol_kalitka" id="kol_kalitka" class="check">
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param">
                        Высота(мм.)
                    </div>
                    <div class="input-param">
                        <select name="height_kalitka" size="1" id="height_kalitka" class="check">
                            <option value=""></option>
                            <?
                            foreach($returnRes['KALITKA']['HEIGHT'] as $val){
                                if($val && !( $val == 130 || $val == 150 )){
                                    echo '<option value="'.$val.'"'.$sel.'>'.($val*10).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param">
                        Ширина(мм.)
                    </div>
                    <div class="input-param">
                         <select name="width_kalitka" size="1" id="width_kalitka" class="check">
                            <?
                            foreach($returnRes['KALITKA']['WIDTH'] as $val){
                                if($val && !( $val == 90 || $val == 120 )){
                                    $val == 100 ? $sel = ' selected' : $sel = '';
                                    echo '<option value="'.$val.'"'.$sel.'>'.($val*10).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param">
                        Открывание
                    </div>
                    <div class="input-param">
                        <?
                        //$i=0;
                        foreach($returnRes['KALITKA']['OTKRIVANIE'] as $val){
                            if($val){ 
                                $val=='правое' ? $checked = ' checked' : $checked = ''; 
                                $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                                echo '<input type="radio" name="type_open_kalitka" value="'.$val.'" id="type_open_kalitka_'.$valTranslit.'"'.$checked.'><label for="type_open_kalitka_'.$valTranslit.'">'.$val.'</label>';
                               // $i++;
                            } 
                        }
                        ?>
                    </div>
                </div>
                
                <div class="wrap-params">
                    <div class="name-param">
                        Установка
                    </div>
                    <div class="input-param">
                        <?
                        //$i=0;
                        foreach($returnRes['KALITKA']['TYPE_INSTALL'] as $val){
                            if($val){
                                $val=='под бетонирование' ? $checked = ' checked' : $checked = '';
                                $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                                echo '<input type="radio" name="type_install_kalitka" value="'.$val.'" id="type_install_kalitka_'.$valTranslit.'"'.$checked.'><label for="type_install_kalitka_'.$valTranslit.'">'.$val.'</label>';
                                //$i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <span class="add-input add-input-wrap">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span class="add">добавить (если другой размер)</span>
            </span>

        </div>
    </div>

    <div class="fields-wrap clearfix">
        <div class="input-name">Ворота</div>
        <div class="input-wrap">
            <div class="wrap-line">
                <input type="checkbox" name="vorota" id="vorota">
                
                <input type="radio" name="type_vorot" checked id="vorota_standart" value="vorota_standart"><label for="vorota_standart">Стандарт</label>
                <input type="radio" name="type_vorot" id="vorota_fit" value="vorota_fit"><label for="vorota_fit">Фит</label>
                <input type="radio" name="type_vorot" id="vorota_otkatnie" value="vorota_otkatnie"><label for="vorota_otkatnie">Откатные</label>
            </div>
            <div class="clear"></div>
            <div class="wrap-params">
                <div class="name-param">
                    Количество
                </div>
                <div class="input-param">
                    <input type="text" name="kol_vorot" id="kol_vorot" class="check">
                </div>
            </div>
            
            <div class="wrap-params">
                <div class="name-param">
                    Высота(мм.)
                </div>
                <div class="input-param">
                    <select name="height_vorot" size="1" id="height_vorot" class="check">
                       <option value=""></option>
                       <?
                        foreach($returnRes['VOROTA']['HEIGHT'] as $val){
                            if($val && $val != 150){
                                echo '<option value="'.$val.'"'.$sel.'>'.($val*10).'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="wrap-params">
                <div class="name-param">
                    Ширина(мм.)
                </div>
                <div class="input-param">
                     <select name="width_vorot" size="1" id="width_vorot" class="check">
                        <option value=""></option>
                        <?
                        foreach($returnRes['VOROTA']['WIDTH'] as $val){
                            if($val){
                                echo '<option value="'.$val.'"'.$sel.'>'.($val*10).'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="wrap-params">
                <div class="name-param">
                    Открывание
                </div>
                <div class="input-param">
                    <?
                    //$i=0;
                    foreach($returnRes['VOROTA']['OTKRIVANIE'] as $val){
                        if($val){
                            $val=='наружное' ? $checked = ' checked' : $checked = ''; 
                            $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                            echo '<input type="radio" name="type_open_vorot" value="'.$val.'" id="type_open_vorot_'.$valTranslit.'"'.$checked.'><label for="type_open_vorot_'.$valTranslit.'">'.$val.'</label>';
                            //$i++;
                        }
                    }
                    ?>
                </div>
            </div>
            
            <div class="wrap-params">
                <div class="name-param">
                    Установка
                </div>
                <div class="input-param">
                    <?
                    $i=0;
                    foreach($returnRes['VOROTA']['TYPE_INSTALL'] as $val){
                        if($val){
                            $val=='под бетонирование' ? $checked = ' checked' : $checked = ''; 
                            $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                            echo '<input type="radio" name="type_install_vorot" value="'.$val.'" id="type_install_vorot_'.$valTranslit.'"'.$checked.'><label for="type_install_vorot_'.$valTranslit.'">'.$val.'</label>';
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
            
            

        </div>
    </div>



    <div class="fields-wrap clearfix">
        <div class="input-name">Крепление</div>
        <div class="input-wrap">
            <input type="radio" name="kreplenie" checked id="homut" value="homut"><label for="homut">хомут</label>
            <input type="radio" name="kreplenie" class="planka_prigim" id="planka_prigim" value="planka_prigim"><label for="planka_prigim">прижимная планка</label> <? //Планка прижимная ПП.40.30 полимер?>
            <input type="radio" name="kreplenie" class="planka_samores" disabled id="planka_samores" value="planka_samores"><label for="planka_samores">планка + саморез (ККДКС)</label> <? //Комплект крепления КК.DKC?>
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Антивандальный крепеж (удорожание ограждения)</div>
        <div class="input-wrap">
            <input type="checkbox" name="antivand_krepeg" id="antivand_krepeg">
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Окрашивание</div>
        <div class="input-wrap clearfix" id="input_wrap_color">
            <div class="inline-params">
                <input type="radio" name="color" id="green" checked value="RAL-6005"><label for="green">зелёный<br>RAL-6005</label>
            </div>
            <div class="inline-params">
                <input type="radio" name="color" id="blue" value="RAL-5005"><label for="green">синий<br>RAL-5005</label>
            </div>
            <div class="inline-params"> 
                <input type="radio" name="color" id="grey" value="RAL-7040"><label for="grey">серый<br>RAL-7040</label>
            </div>
            <div class="inline-params">
                <input type="radio" name="color" id="brown" value="RAL-8017"><label for="brown">коричневый<br>RAL-8017</label>
            </div>
            <div class="inline-params">
                <input type="radio" name="color" id="cink" value="цинк"><label for="cink">цинк</label>
            </div>
                <?
                /*foreach($arPokritie as $val){
                    if($val)
                        echo '<option value="'.$val.'">'.$val.'</option>';
                }*/
                ?>
            <div class="clear"></div>
            <div class="inline-params">
                <input type="radio" name="color" id="other_color" value="other_color"><label for="other_color">другой цвет</label>
                цвет по шкале RAL <input type="text" name="color_your" id="color_your" value="" class="check">
            </div>            
            <?/*
            <div class="">
                Или введите цвет по шкале RAL <input type="text" name="color_your" id="color_your" value="">
            </div>*/?>
        </div>
        
    </div>

    <div class="fields-wrap clearfix">
        <div class="input-name">СББ Егоза</div>
        <div class="input-wrap">
            <div class="wrap-params">
                <div class="name-param">
                    <input type="checkbox" name="egoza_sbb" id="egoza_sbb" class="check">
                </div>
            </div>
            <div class="block-params">
                <div class="wrap-params">
                    <div class="name-param">
                        Периметр
                    </div>
                    <div class="input-param">
                        <input type="text" name="egoza_perimetr_sbb[]" value="" class="check">
                    </div>
                </div>
                <div class="wrap-params">
                    <div class="name-param">
                        Диаметр <br>спирали(мм.)
                    </div>
                    <div class="input-param">
                        <select name="diametr_yagozi_sbb[]" size="1" class="diametr_yagozi_sbb check">
                            <option value="" selected="selected"></option>
                            <?
                            foreach($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI']['СББ'] as $val){
                                if($val){ 
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                            }
                            ?>                    
                        </select>
                    </div>
                </div> 
                
                <div class="wrap-params">
                    <div class="name-param">
                        Количество витков
                    </div>
                    <div class="input-param">
                        <select name="kol_vitkov_yagozi_sbb[]" size="1" class="kol_vitkov_yagozi_sbb check">
                            <option value="" selected="selected"></option>
                            <?
                            foreach($returnRes['YAGOZA']['TYPE_KOL_VITKOV']['СББ'] as $val){
                                if($val){ 
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                            }
                            ?>                   
                        </select>
                    </div>
                </div>
            </div>
            <span class="add-input add-input-wrap">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span class="add">добавить (если другой размер)</span>
            </span>
        </div>
        
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">ПББ Егоза</div>
        <div class="input-wrap">
            <div class="wrap-params">
                <div class="name-param">
                    <input type="checkbox" name="egoza_pbb" id="egoza_pbb" class="check">
                </div>
            </div>
            <div class="block-params">
                <div class="wrap-params">
                    <div class="name-param">
                        Периметр
                    </div>
                    <div class="input-param">
                        <input type="text" name="egoza_perimetr_pbb[]" value="" class="check">
                    </div>
                </div>
                <div class="wrap-params">
                    <div class="name-param">
                        Диаметр <br>спирали(мм.)
                    </div>
                    <div class="input-param">
                        <select name="diametr_yagozi_pbb[]" size="1" class="diametr_yagozi_pbb check">
                            <option value="" selected="selected"></option>
                            <?
                            foreach($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI']['ПББ'] as $val){
                                if($val){ 
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                            }
                            ?>                   
                        </select>
                    </div>
                </div> 
                
                <div class="wrap-params">
                    <div class="name-param">
                        Количество витков
                    </div>
                    <div class="input-param">
                        <select name="kol_vitkov_yagozi_pbb[]" size="1" class="kol_vitkov_yagozi_pbb check">
                            <?
                            foreach($returnRes['YAGOZA']['TYPE_KOL_VITKOV']['ПББ'] as $val){
                                if($val){ 
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                            }
                            ?>                 
                        </select>
                    </div>
                </div>
            </div>
            <span class="add-input add-input-wrap">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span class="add">добавить (если другой размер)</span>
            </span>
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Штанги</div>
        <div class="input-wrap" id="input_wrap_type_shtanga">
            <input type="checkbox" name="shtanga" id="shtanga">
            <?
            foreach($returnRes['STANGI']['TYPE'] as $val){
                if($val){ 
                    $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                    echo '<input type="radio" name="type_shtanga" value="'.$val.'" id="stanli_'.$valTranslit.'"><label for="stanli_'.$valTranslit.'">'.$val.'</label>';
                }
            }
            ?>
        </div>
    </div>
    
    <div class="fields-wrap clearfix">
        <div class="input-name">Длина штанги</div>
        <div class="input-wrap" id="input_wrap_dlina_shtanga">
            <?
            //$i=0;
            foreach($returnRes['STANGI']['DLINA'] as $val){
                if($val){ 
                    //$i==0 ? $checked = ' checked' : $checked = '';
                    $valTranslit = Cutil::translit($val, LANGUAGE_ID, $arParamsTranslit);
                    echo '<input type="radio" name="dlina_shtanga" value="'.$val.'" id="dlina_stanli_'.$valTranslit.'"><label for="dlina_stanli_'.$valTranslit.'">'.$val.'</label>';
                }
                //$i++;
            }
            ?>
        </div>
    </div>
    
    

    <div class="fields-wrap clearfix">
        <div class="input-name">Козырек</div>
        <div class="input-wrap">
            <input type="checkbox" name="kozirek" id="kozirek">
            Введите периметр <input type="text" name="kozirek_perimetr" value="" id="kozirek_perimetr" class="check">
        </div>
    </div>

    </div>
    
    <div class="result">
    </div>
    
    <div class="text-your-color hidden">
        При заказе менее 1 упаковки в нестандартном цвете +50% наценки + перекомплектация.<br>
        При заказе более 1 упаковки в нестандартном цвете +15% наценки.<br>
        При заказе более 2 упаковок в нестандартном цвете +7% наценки.<br>
    </div>
    <div class="clearfix submit-wrap">
        <input type="button" class="submit-form btn btn-yellow" id="calculate" value="Рассчитать">
        <a href="/calculator/"><input type="button" class="btn btn-yellow" value="Сбросить"></a>
    </div>
    
    </form>
    
    <div class="order-form hidden">
        <form method="post" id="order_form" action="calc.php">
            <div class="errortext result-odrer-errortext"></div>
            <div class="fields-wrap clearfix">
                <div class="input-name">Имя <?/*<span class="star">*</span>*/?></div>
                <div class="input-wrap">
                   <input type="text" name="ORDER_PROPS[NAME]" value="" id="prop_id_NAME">
                </div>
            </div>
            
            <?/*<div class="fields-wrap clearfix">
                <div class="input-name">Телефон <span class="star">*</span></div>
                <div class="input-wrap">
                   <input type="text" name="ORDER_PROPS[PHONE]" value="" class="phone" id="prop_id_PHONE">
                </div>
            </div>*/?>
            
            <?/*<div class="fields-wrap clearfix">
                <div class="input-name">Email <span class="star">*</span></div>
                <div class="input-wrap">
                   <input type="text" name="ORDER_PROPS[EMAIL]" value="" id="prop_id_EMAIL">
                </div>
            </div>*/?>
            
            <div class="fields-wrap clearfix">
                <div class="input-name">Комментарий</div>
                <div class="input-wrap">
                   <textarea name="ORDER_PROPS[COMMENT]" id="comment_user"></textarea>
                   <input type="hidden" name="ORDER_PROPS[COMMENT_COLOR]" id="comment_color">
                </div>
            </div>
            
			<?=bitrix_sessid_post()?>	
            <div class="submit-wrap">
                <input type="button" class="btn btn-yellow" id="order_submit" value="Оформить заказ">
            </div>
		</form>
    </div>
    <div class="result-order"></div>
</div>
<?global $USER;?>
<?if($USER->IsAuthorized()):?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#prop_id_NAME').val('<?=$USER->GetFullName()?>');
        $('#prop_id_EMAIL').val('amir-bayazitov@mail.ru');
		<?//=$USER->GetEmail()?>
    });
    </script>
<?endif;?>
<?
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['F']['3100']['2500']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['F']['3100']['3000']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['F']['4100']['2500']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['F']['4100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['О']['3100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['О']['3100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['О']['4100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['О']['4100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['L']['3100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['L']['3100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['L']['4100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['L']['4100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['М']['3100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['М']['3100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['М']['4100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['М']['4100']['3000']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['Е']['3100']['2500']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['Е']['3100']['3000']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['Е']['4100']['2500']=true;
// $returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['Е']['4100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['P']['3100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['P']['3100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['P']['4100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['P']['4100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['I']['3100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['I']['3100']['3000']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['I']['4100']['2500']=true;
$returnRes['PANELI']['TYPE_HEIGHT_WIDTH']['I']['4100']['3000']=true;

?>
<?
//СОТВЕТСТВИЕ типа панели и ширины и ВЫСОТ ОГРАЖДЕНИЯ И СЕЧЕНИЯ СТОЛБОВ
$arSechenieTypeWidthHeight = array(
    'F' => array(
        '2500' =>array(
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
        ),
        
        '3000' =>array(
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
        ),
                
    ),
    
    'О' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),   
    
    'L' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),        
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),    
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
        ),         
    ), 
    'М' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1630' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1830' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),   
            '3100' => array( // 2030+1030
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '80*80*2',
                    ),
        ),     
    ),  

    'Е' => array(
        '2500' =>array(
            '640' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1040' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1240' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1440' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
        ),     
    ),  

    'P' => array( // взято от O
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),   
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),    
  
    'I' => array( // взято от O
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),   
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ), 
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),       
);

$returnRes['PANELI']['TYPE_HEIGHT']['L']['3100'] = '3100';
$returnRes['PANELI']['TYPE_HEIGHT']['L']['4100'] = '4100';
$returnRes['PANELI']['TYPE_HEIGHT']['О']['3100'] = '3100';
$returnRes['PANELI']['TYPE_HEIGHT']['О']['4100'] = '4100';
$returnRes['PANELI']['TYPE_HEIGHT']['М']['3100'] = '3100';
$returnRes['PANELI']['TYPE_HEIGHT']['М']['4100'] = '4100';
$returnRes['PANELI']['TYPE_HEIGHT']['P']['3100'] = '3100';
$returnRes['PANELI']['TYPE_HEIGHT']['P']['4100'] = '4100';
$returnRes['PANELI']['TYPE_HEIGHT']['I']['3100'] = '3100';
$returnRes['PANELI']['TYPE_HEIGHT']['I']['4100'] = '4100';

$returnRes['PANELI']['HIGHT_TYPE'][3100] = array(
    'L'=>'L',
    'О'=>'О',
    'М'=>'М',
    'P'=>'P',
    'I'=>'I',
);

$returnRes['PANELI']['HIGHT_TYPE'][4100] = array(
    'L'=>'L',
    'О'=>'О',
    'М'=>'М',
    'P'=>'P',
    'I'=>'I',
);
?>

<?
//СОТВЕТСТВИЕ типа панели, ВЫСОТ ОГРАЖДЕНИЯ И СЕЧЕНИЯ СТОЛБОВ
$arSechenieHeight = array( 
    'F' => array(

        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.2',
                ),
        '1530' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.2',
                ),
        '1730' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.2',
                ),
        '1930' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.2',
                ),    
    ),
    
    'О' => array(
        '630' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1030' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1430' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1530' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1730' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1930' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2030' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2230' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2430' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2630' => array(
                    'HEIGHT_STOLBA' => 3500,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '2830' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '2930' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '3100' => array( // 1530+1530
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '4100' => array( // 2030+2030
                    'HEIGHT_STOLBA' => 5000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),    
    ),   
    
    'L' => array(

        '630' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1030' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1430' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1530' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1730' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1930' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2030' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2230' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2430' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2630' => array(
                    'HEIGHT_STOLBA' => 3500,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),        
        '2930' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '3100' => array( // 1530+1530
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '4100' => array( // 2030+2030
                    'HEIGHT_STOLBA' => 5000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
    ), 
    'М' => array(
        '630' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1030' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1430' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1630' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1830' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2030' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2230' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2430' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2630' => array(
                    'HEIGHT_STOLBA' => 3500,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),   
        '3100' => array( // 2030+1030
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '4100' => array( // 2030+2030
                    'HEIGHT_STOLBA' => 5000,
                    'SECHENIE_STOLBA' => '80*80*2',
                ),   
    ),  
    'Е' => array(
        '640' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1040' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1240' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1440' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),    
    ),  
    'P' => array( // взято от O
        '630' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1030' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1430' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1530' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1730' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1930' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2030' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2230' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2430' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2630' => array(
                    'HEIGHT_STOLBA' => 3500,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),   
        '2830' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '2930' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '3100' => array( // 1530+1530
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '4100' => array( // 2030+2030
                    'HEIGHT_STOLBA' => 5000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ), 
    ),    
  
    'I' => array( // взято от O
        '630' => array(
                    'HEIGHT_STOLBA' => 1150,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1030' => array(
                    'HEIGHT_STOLBA' => 1500,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1230' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1430' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1530' => array(
                    'HEIGHT_STOLBA' => 2000,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1730' => array(
                    'HEIGHT_STOLBA' => 2300,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '1930' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2030' => array(
                    'HEIGHT_STOLBA' => 2600,
                    'SECHENIE_STOLBA' => '60*40*1.5',
                ),
        '2230' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2430' => array(
                    'HEIGHT_STOLBA' => 3000,
                    'SECHENIE_STOLBA' => '60*60*1.5',
                ),
        '2630' => array(
                    'HEIGHT_STOLBA' => 3500,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),   
        '2830' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '2930' => array(
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '3100' => array( // 1530+1530
                    'HEIGHT_STOLBA' => 4000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
        '4100' => array( // 2030+2030
                    'HEIGHT_STOLBA' => 5000,
                    'SECHENIE_STOLBA' => '60*60*2',
                ),
    ),       
);
?>

<?
$diamTypeStangaDlina = array();
$diamTypeStangaDlina['450']['V']['300'] = 1;
$diamTypeStangaDlina['500']['V']['300'] = 1;
$diamTypeStangaDlina['600']['V']['300'] = 1;

$diamTypeStangaDlina['450']['Г']['300'] = 1;
$diamTypeStangaDlina['500']['Г']['300'] = 1;
$diamTypeStangaDlina['600']['Г']['300'] = 1;

$diamTypeStangaDlina['450']['I']['700'] = 1;
$diamTypeStangaDlina['500']['I']['700'] = 1;
$diamTypeStangaDlina['600']['I']['700'] = 1;

$diamTypeStangaDlina['900']['V']['500'] = 1;
$diamTypeStangaDlina['900']['Г']['500'] = 1;
$diamTypeStangaDlina['900']['I']['1100'] = 1;


?>


<script>
$(document).ready(function(){
    
    $('#add_storona').on('click', function(){
        var $storoni = $('.wrap-storona');
            cntStoron = $('.wrap-storona').length,
            nextStorona = cntStoron + 1,
            wrapStorona = $('.wrap-storona').eq(0),
            wrapStoronaClone = wrapStorona.clone();
            
        wrapStoronaClone.find('.storona').attr({'id':'storona'+nextStorona, 'name':'storona'+nextStorona, 'placeholder':'участок '+nextStorona}).val('');     
        wrapStoronaClone.find('.height-paneli').attr({'id':'height_paneli'+nextStorona, 'name':'height_paneli'+nextStorona}).find('option:first').attr('selected', 'selected');    
        wrapStoronaClone.find('.sechenie-stolba').attr({'id':'sechenie_stolba'+nextStorona, 'name':'sechenie_stolba'+nextStorona}).find('option:first').attr('selected', 'selected');    
        
        wrapStoronaClone.insertBefore($(this));
        $('#sechenie_stolba'+nextStorona).after('<span class="del-storona"><i class="fa fa-minus-circle" aria-hidden="true"></i><span>удалить</span></span>');
    });
    $('body').on('click','.del-storona', function(){
        $(this).closest('.wrap-storona').remove();
    });
    
    $('.add-input-wrap').on('click', function(){
        var $blockParam = $(this).prev('.block-params');
            // cntBlockParams = $('.block-params').length,
            // nextBlockParam = cntBlockParams + 1,
            //blockParam = $('.block-params').eq(0),
            blockParamClone = $blockParam.clone();
console.log('blockParam', $blockParam);
        if(blockParamClone.find('.del-wrap').length == 0)
            blockParamClone.find('.input-param:last').append('<span class="del-wrap"><i class="fa fa-minus-circle" aria-hidden="true"></i><span>удалить</span></span>');
        
        blockParamClone.find('input').each(function(indx, element){
console.log(element, 'element');
//console.log($(element).attr('id'), 'id');
            $(element).val('');
        });
        
        blockParamClone.find('select').each(function(indx, element){
console.log(element, 'element');
//console.log($(element).attr('id'), 'id');
            $(element).find('option:first').attr('selected', 'selected');
        });
        blockParamClone.insertBefore($(this));
       
    });
    $('body').on('click','.del-wrap', function(){
        $(this).closest('.block-params').remove();
    });
    
    
    
    $('#add_height').on('click', function(){
        $(this).before('<span id="height_dop_wrap"><input class="height-dop" type="text" name="height-dop" id="height_dop" placeholder="высота"> м.</span>').hide();
        $('#height option:nth-child(1)').attr("selected", "selected");
    });
    
    
    $('.calculator').on("change keyup input click", '#height_dop', function() {

        if (this.value.match(/[^0-9\.]/g)) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        }
        if (this.value.match(/[0-9]*\.[0-9]*\./g)) {
            this.value = this.value.replace(/\.$/g, '');
        }
    });
    
    $('.calculator').on("change keyup input click", '.storona, #perimetr', function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    }); 
    
//// рассчёты
    var typesOb  = {
        prom : ['М','L','О'],
        neft : ['О','I'],
        aero : ['О','I'],
        sport : ['О','М'],
        'sport-other' : ['М','О'],
        'admin-house' : ['L','О','F','Е'],
        kottedji : ['L','О','F','Е'],
        detskie : ['М','L','О','Е','P'],
        parki : ['М','L','О','Е','P'],
        selhoz : ['F','L'],
        tek : ['О','М'],
        azs : ['F','L','I'],
        zd : ['О','L','М'],
        magistrali : ['О','L','М'],
        vpo : ['О','I','М'],
        other : ['О'],
    };
    
    
    var heightType = <?=CUtil::PhpToJSObject($returnRes['PANELI']['HIGHT_TYPE'])?>;
    var typeHeight = <?=CUtil::PhpToJSObject($returnRes['PANELI']['TYPE_HEIGHT'])?>;
    var typeHeightWidth = <?=CUtil::PhpToJSObject($returnRes['PANELI']['TYPE_HEIGHT_WIDTH'])?>;
    var heightSechenieTypeinstall = <?=CUtil::PhpToJSObject($returnRes['STOLBI']['DLINA_TYPE_INSTALL'])?>; //
    var stolbiSechenieHeight = <?=CUtil::PhpToJSObject($returnRes['STOLBI']['SECHENIE_HEIGHT'])?>; // соотношение сечения высоте столба
    var sechenieHeight = <?=CUtil::PhpToJSObject($arSechenieHeight)?>;
    //var sechenieTypeWidthHeight = <?=CUtil::PhpToJSObject($arSechenieTypeWidthHeight)?>;
    var stangiTypeDlina = <?=CUtil::PhpToJSObject($returnRes['STANGI']['TYPE_DLINA'])?>;
    var vorotaTypeHeightWidthOtkrivanieTypeinstall = <?=CUtil::PhpToJSObject($returnRes['VOROTA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL'])?>;
    var valitkaTypeHeightWidthOtkrivanieTypeinstall = <?=CUtil::PhpToJSObject($returnRes['KALITKA']['HEIGHT_WIDTH_OTKRIVANIE_TYPE_INSTALL'])?>;
    var yagozaTypeDiametrKolVitkov = <?=CUtil::PhpToJSObject($returnRes['YAGOZA']['TYPE_DIAMETR_YAGOZI_KOL_VITKOV'])?>;
    var diamTypeStangaDlina = <?=CUtil::PhpToJSObject($diamTypeStangaDlina)?>;
    
    
console.log('yagozaTypeDiametrKolVitkov', yagozaTypeDiametrKolVitkov);
// console.log('typeHeightWidth', typeHeightWidth);
// console.log('stangiTypeDlina', stangiTypeDlina);
// console.log('heightType', heightType);
// console.log('typeHeight', typeHeight);
// console.log('heightSechenieTypeinstall', heightSechenieTypeinstall);
// console.log('stolbiSechenieHeight', stolbiSechenieHeight);
// console.log('sechenieHeight', sechenieHeight);
// console.log('vorotaTypeHeightWidthOtkrivanieTypeinstall', vorotaTypeHeightWidthOtkrivanieTypeinstall);
// console.log('valitkaTypeHeightWidthOtkrivanieTypeinstall', valitkaTypeHeightWidthOtkrivanieTypeinstall);
    /*var vidOb  = {
        prom : ['3D','2D'],
        neft : ['3D'],
        aero : ['3D'],
        sport : ['3D','2D'],
        'sport-other' : ['3D'],
        'admin-house' : ['3D','2D'],
        kottedji : ['3D','2D'],
        detskie : ['3D','2D'],
        parki : ['3D','2D'],
        selhoz : ['3D'],
        tek : ['3D'],
        azs : ['3D'],
        zd : ['3D'],
        magistrali : ['3D'],
        vpo : ['3D'],
        other : ['3D'],
    };*/
     
    var sechenie = {
        prom : ['60*40','60*60','80*80'],   
        neft : ['60*60','80*80'],   
        aero : ['60*60','80*80'],   
        sport : ['60*60','80*80'],   
        'sport-other'  : ['60*40','60*60','80*80'],   
        'admin-house' : ['60*40','60*60','80*80'],   
        kottedji : ['60*40','60*60','80*80'],   
        detskie : ['60*40','60*60'],   
        parki : ['60*40','60*60','80*80'],   
        selhoz : ['60*40'],   
        tek : ['60*40','60*60','80*80'],   
        azs : ['60*40','60*60'],   
        zd : ['60*40','60*60','80*80'],   
        magistrali : ['60*40','60*60','80*80'],   
        vpo : ['60*60','80*80'],   
        other : ['60*40','60*60','80*80'],   
    };
    
    var vorotaVisota = {
        vorota_standart : ['160','180','210','250'], // 1600/10 в мм/10
        vorota_fit : ['160','180','200'], 
        vorota_otkatnie : ['160','180','210','250'],
    }
    
    var vorotaWidth = { 
        vorota_standart : ['300','400','500','600'], // 3000/10 в мм/10
        vorota_fit : ['350'], 
        vorota_otkatnie : ['300','400','500','600'],
    }
    
    var kalitkaVisota = {
        kalitka_standart : ['160','180','210','250'], // 1600/10 в мм/10
        kalitka_fit : ['160','180','200'], 
    }
    
    var kalitkaWidth = { 
        kalitka_standart : ['100'], // 3000/10 в мм/10
        kalitka_fit : ['100'], 
    }  
    
    // выбор типа объекта 
    $('#type_ob').on('change', function(){
        var typeOb = $(this).val();
        
        /*if(typeOb){
            $('#other_fields').removeClass('hidden');
            $('#calculate').removeClass('disabled').prop('disabled', false);
        }
        else{
            $('#other_fields').addClass('hidden');
            $('#calculate').addClass('disabled').prop('disabled', false);
            return false;
        }*/
// console.log('typeOb', typeOb);       
// console.log('typesOb[typeOb]', typesOb[typeOb]);            
//console.log('sechenie[typeOb]', sechenie[typeOb]);       

        /*for(var key in typesOb[typeOb]){
console.log('typeOb val', typesOb[typeOb][key]);  
            
        }*/
        var typePanelActive = [];
        var i = 0;
        //$('input[name="type_panel"]').data('disabled_type','Y')
        
        $('input[name="type_panel"]').each(function(indx, element){

            if(find(typesOb[typeOb], $(element).val()) == -1 ){
                $(element).addClass('disabled');
            }
            else{
                $(element).removeClass('disabled');
                //$(element).data('disabled_type','N');
                typePanelActive[i++] = element;
            }
        }); 
//console.log('typePanelActive',typePanelActive);
        // убираем высоты которых нет для данного Типа панели
        //$('#height_paneli1 option').prop('disabled', true);
        /*$('#height_paneli1 option').addClass('disabled');
        var arHeightOfType = '';
        var isStolbiSech = false;
        for(var key in typePanelActive){ 

            arHeightOfType = typeHeight[$(typePanelActive[key]).val()];
            for(var keyHeght in arHeightOfType){
                //// и если есть столбы доступного сечения
                // for(keySechenie in sechenie[typeOb]){
                    // if(arSechHeightStolb[sechenie[typeOb][keySechenie]]){ // "60*60", "80*80"
                        // isStolbiSech = true;
                        // $('#height_paneli1 option[value='+arHeightOfType[keyHeght]+']').prop('disabled', false);
                        // break;
                    // } 
                // }
                
                //$('#height_paneli1 option[value='+arHeightOfType[keyHeght]+']').prop('disabled', false);
                $('#height_paneli1 option[value='+arHeightOfType[keyHeght]+']').removeClass('disabled');
            }
        }   
        $('#height_paneli1 option:first').attr('selected', 'selected');  */
            
        
       /* $('input[name="vid_panel"]').each(function(indx, element){

            if(findPos(vidOb[typeOb], $(element).val()) == -1 ){ // value = 3D (6мм)  - vidOb[typeOb][i] = 3D    (array[i])
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });*/
        
        /*$('#sechenie_stolba option').each(function(indx, element){

            if(findPos(sechenie[typeOb], $(element).val()) == -1 ){ // value = 60*40*1.2  - sechenie[typeOb][i] = 60*40   (array[i])
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });*/
    });
    
    // выбор типа панели
    $('input[name="type_panel"]').on('click', function(){
        
        var typePaneni = $(this).val();
        var $storoni = $('.wrap-storona'),
            cntStoron = $('.wrap-storona').length;
console.log('cntStoron', cntStoron);
console.log('typePaneni', typePaneni);
console.log('typeHeightWidth[typePaneni]', typeHeightWidth[typePaneni]);

       
        for(var i=1; i <= cntStoron; i++)
        {
            var val=0;
            $('#height_paneli'+i+' option:gt(0)').each(function(indx, element){
                val = $(element).val();
                if(typeHeightWidth[typePaneni][val]){
                    $(element).prop('disabled', false);
                }
                else{
                    $(element).prop('disabled', true);
                    // если выбранное значение то сбрасываем select
                    if($(element).is(':checked'))
                        $(element).closest('select').find('option:first').attr('selected', 'selected'); 
                }
            });
        };
        
        // подбираем сечение и тип столба
        
        // if(typePaneni == 'М' || typePaneni == 'I' || typePaneni == 'Е'){ // тогда нет длины 3000
            // $('#width option[value="2500"]').attr('selected', 'selected');  
            // $('#width option[value="3000"]').prop('disabled', true);  
        // }
        // else{
            // $('#width option[value="3000"]').prop('disabled', false);
        // }
        
        // var widthPaneni = $('#width').val();
        // if(widthPaneni){
            //var heightPaneli = $('#height').val();

            setCechenieStolba(typePaneni/*, widthPaneni*/);
        //}
        
        // 
        if(typePaneni == 'F'){
            $('input[name="kreplenie"].planka_samores').prop('disabled', false);
        }
        else{
//console.log
            if($('input.planka_samores').is(':checked')){
                $('input.planka_samores').prop('checked', false);
                $('input.planka_prigim').trigger('click');
            }
            $('input.planka_samores').prop('disabled', true);
        }
          
    });
    
    // выбор высоты ограждения
    $('body').on('change','.height-paneli', function(){
        //var heightPaneli = $(this).val();
//console.log('heightType[heightPaneli]', heightType[heightPaneli]);
// старый вариант
        // var valElType = heightPaneli = '';
        // $('input[name="type_panel"]').prop('disabled', false);
        
        // $('.height-paneli').each(function(indxH, elementHeight){ // выберем все высоты панелей
            // heightPaneli = $(elementHeight).val();
            // $('input[name="type_panel"]').each(function(indx, elementType){
                // valElType = $(elementType).val();
                // if(!heightType[heightPaneli][valElType] /*|| $(element).data('disabled_type') == 'Y'*/){
                    // $(elementType).prop('disabled', true);
                // }
                
            // });
        // });
        
        // $('#height_dop_wrap').remove();
        // $('#add_height').show();
        // // уберём выбор Типа панели
        // //$('input[name="type_panel"]:checked').prop('checked', false);
        // $('input[name="type_panel"]').prop('checked', false); 
//новый
        var heightPaneni = $(this).val();
console.log('type_panel length', $('input[name="type_panel"]:checked').length);
        if($('input[name="type_panel"]:checked').length == 0){
            alert('выберите тип панели');
            return false;
        }
        var typePaneni =  $('input[name="type_panel"]:checked').val();
console.log('typeHeightWidth', typeHeightWidth);
console.log('heightPaneni', heightPaneni);
console.log('typePaneni', typePaneni);
console.log('typeHeightWidth heightPaneni', typeHeightWidth[typePaneni][heightPaneni]);


        $('#width option:gt(0)').each(function(indx, element){
            if(typeHeightWidth[typePaneni][heightPaneni][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
                // если выбранное значение то сбрасываем select
                if($(element).is(':checked'))
                    $('#width option:first').attr('selected', 'selected');  
            }
        });
        
        //var widthPaneni = $('#width').val();
//console.log('widthPaneni', widthPaneni);
        //if(widthPaneni){
            setCechenieStolba(typePaneni/*, widthPaneni*/);
        //}
        
    });
    
    
    
    // смена длины панели
    $('#width').on('change', function(){
        
        // подбираем сечение и тип столба
        //var widthPaneni = $(this).val();
//console.log('widthPaneni', widthPaneni);
        //var typePaneni =  $('input[name="type_panel"]:checked').val();
        //var heightPaneli = $('#height').val();
        //setCechenieStolba(typePaneni, widthPaneni); 
    });
    
    function setCechenieStolba(typePaneni/*, widthPaneni*/)
    {
        //if(widthPaneni == 2400)
          //  widthPaneni = 2500;
//console.log('widthPaneni', widthPaneni);
        $('.height-paneli').each(function(indx, elementHeight){ // выберем все высоты панелей
            heightPaneli = $(elementHeight).val();
 

console.log('sechenieHeight arr', sechenieHeight);
console.log('sechenieHeight 3', sechenieHeight[typePaneni]/*[widthPaneni]*/[heightPaneli]);
            if(typePaneni && heightPaneli /*&& widthPaneni*/){
                var heightStolba = sechenieHeight[typePaneni]/*[widthPaneni]*/[heightPaneli]['HEIGHT_STOLBA'];
                var sechenieStolba = sechenieHeight[typePaneni]/*[widthPaneni]*/[heightPaneli]['SECHENIE_STOLBA'];
                
                $(elementHeight).closest('.wrap-storona').find('.sechenie-stolba option[value="'+sechenieStolba+'"]').attr('selected', 'selected');
                
console.log('sechenieStolba', sechenieStolba);
            }
        });
    }
    
    
    // галка выбор крепления
    $('body').on('click', 'input[name="kreplenie"]', function(){
        
        if( $(this).val() == 'planka_samores'){
            $('#antivand_krepeg').prop({'disabled':true, 'checked' : false});
        }
        else{
            $('#antivand_krepeg').prop({'disabled':false});
        }
            
    });
    
    // галка ворота
    $('body').on('click', 'input[name="vorota"]', function(){
        
        if(!$(this).is(':checked')){
            $('input[name="type_vorot"]').prop('disabled', true);
            $('input[name="kol_vorot"]').prop('disabled', true);
            $('select[name="height_vorot"]').attr('disabled', 'disabled');
            $('select[name="width_vorot"]').attr('disabled', 'disabled');
            $('input[name="type_open_vorot"]').prop('disabled', true);
            $('input[name="type_install_vorot"]').prop('disabled', true);
        }
        else{
            $('input[name="type_vorot"]').prop('disabled', false);
            $('input[name="kol_vorot"]').prop('disabled', false);
            $('select[name="height_vorot"]').removeAttr('disabled');
            $('select[name="width_vorot"]').removeAttr('disabled');
            $('input[name="type_open_vorot"]').prop('disabled', false);
            $('input[name="type_install_vorot"]').prop('disabled', false);
        }
    });
    
    // галка калитка
    $('body').on('click', 'input[name="kalitka"]', function(){
  
        if(!$(this).is(':checked')){
        
            $('input[name="type_kalitka"]').prop('disabled', true);
            $('input[name="kol_kalitka"]').prop('disabled', true);
            $('select[name="height_kalitka"]').attr('disabled', 'disabled');
            $('select[name="width_kalitka"]').attr('disabled', 'disabled');
            $('input[name="type_open_kalitka"]').prop('disabled', true);
            $('input[name="type_install_kalitka"]').prop('disabled', true);
        }
        else{
            $('input[name="type_kalitka"]').prop('disabled', false);
            $('input[name="kol_kalitka"]').prop('disabled', false);
            $('select[name="height_kalitka"]').removeAttr('disabled');
            $('select[name="width_kalitka"]').removeAttr('disabled');
            $('input[name="type_open_kalitka"]').prop('disabled', false);
            $('input[name="type_install_kalitka"]').prop('disabled', false);
        }
    });
    
    // галка ягоза сбб
    $('body').on('click', 'input[name="egoza_sbb"]', function(){
  
        if(!$(this).is(':checked')){

            $('input[name="egoza_perimetr_sbb[]"]').prop('disabled', true);
            $('select[name="diametr_yagozi_sbb[]"]').prop('disabled', true);
            $('select[name="kol_vitkov_yagozi_sbb[]"]').prop('disabled', true);
        }
        else{
            $('input[name="egoza_perimetr_sbb[]"]').prop('disabled', false);
            $('select[name="diametr_yagozi_sbb[]"]').prop('disabled', false);
            $('select[name="kol_vitkov_yagozi_sbb[]"]').prop('disabled', false);
        }
    });
    
    // галка ягоза пбб
    $('body').on('click', 'input[name="egoza_pbb"]', function(){
  
        if(!$(this).is(':checked')){

            $('input[name="egoza_perimetr_pbb[]"]').prop('disabled', true);
            $('select[name="diametr_yagozi_pbb[]"]').prop('disabled', true);
            $('select[name="kol_vitkov_yagozi_pbb[]"]').prop('disabled', true);
        }
        else{
            $('input[name="egoza_perimetr_pbb[]"]').prop('disabled', false);
            $('select[name="diametr_yagozi_pbb[]"]').prop('disabled', false);
            $('select[name="kol_vitkov_yagozi_pbb[]"]').prop('disabled', false);
        }
    });
    
    // галка штанги
    $('body').on('click', '#shtanga', function(){
  
        if(!$(this).is(':checked')){

            $('input[name="type_shtanga"]').prop('disabled', true);
            $('input[name="dlina_shtanga"]').prop('disabled', true);
        }
        else{
            $('input[name="type_shtanga"]').prop('disabled', false);
            $('input[name="dlina_shtanga"]').prop('disabled', false);
        } 
        

        if($('input[name="egoza_sbb"]').prop('checked')){
            $('input[name="type_shtanga"]').prop({'disabled':true, 'checked':false});
            $('input[name="type_shtanga"][value="V"]').prop({'disabled':false, 'checked':true}).trigger('click');
            $('input[name="egoza_pbb"]').prop({'disabled':true, 'checked':false});
        }
        else if($('input[name="egoza_pbb"]').prop('checked')){
            $('input[name="type_shtanga"]').prop({'disabled':true, 'checked':false});
            $('input[name="type_shtanga"][value="I"]').prop({'disabled':false, 'checked':true}).trigger('click');
            $('input[name="egoza_sbb"]').prop({'disabled':true, 'checked':false});
        }
    });
    
    // галка козырёк
    $('body').on('click', '#kozirek', function(){
  
        if(!$(this).is(':checked')){

            $('input[name="kozirek_perimetr"]').prop('disabled', true);
        }
        else{
            $('input[name="kozirek_perimetr"]').prop('disabled', false);
        }
    });

    // выбор типа ворот
    $('body').on('click', 'input[name="type_vorot"]', function(){
        var typeVorot = $(this).val();
console.log('typeVorot', typeVorot);
console.log('vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot]', vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot]);

        $('#height_vorot option:gt(0)').each(function(indx, element){
            
            if(vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
            }
            
        });
        
        /*$('#height_vorot option:gt(0)').each(function(indx, element){

            if(find(vorotaVisota[typeVorot], $(element).val()) == -1 ){
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });
        
        $('#width_vorot option:gt(0)').each(function(indx, element){

            if(find(vorotaWidth[typeVorot], $(element).val()) == -1 ){
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });       
*/
        $('#height_vorot option:first').attr('selected', 'selected');    
        $('#width_vorot option:first').attr('selected', 'selected'); 
    });
    
    
    // выбор высоты ворот
    $('body').on('change', '#height_vorot', function(){
        var height = $(this).val();
        var typeVorot = $('input[name="type_vorot"]:checked').val();
        $('#width_vorot option:gt(0)').each(function(indx, element){
            
            if(vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][height][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
            }
            
        });
        //if( $('#width_vorot option:selected').attr('disabled') ) // всегда обнуляем выбор: для дальнейших усечений Открывания и Установки
            $('#width_vorot option:first').attr('selected', 'selected'); 
    }); 
    //выбор ширины ворот
    $('body').on('change', '#width_vorot', function(){
        var typeVorot = $('input[name="type_vorot"]:checked').val();
        var height = $('#height_vorot').val();
        var width = $(this).val();
console.log('height', height);
console.log('width', width);
console.log('vorotaTypeHeightWidthOtkrivanieTypeinstall[height]', vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][height]);
        $('input[name="type_open_vorot"]').each(function(indx, element){
            
            if(vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][height][width][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('checked', false);
                $(element).prop('disabled', true);
            }
            
        });
        
        // $('input[name="type_open_vorot"]:checked').prop('checked', false);
        // $('input[name="type_install_vorot"]:checked').prop('checked', false);
    });
    //выбор Открывание ворот
    $('body').on('change', 'input[name="type_open_vorot"]', function(){
        var typeVorot = $('input[name="type_vorot"]:checked').val();
        var height = $('#height_vorot').val();
        var width = $('#width_vorot').val();
        var typeOpen = $(this).val();
console.log('height', height);
console.log('width', width);
console.log('vorotaTypeHeightWidthOtkrivanieTypeinstall[height]', vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][height][width]);
        $('input[name="type_install_vorot"]').each(function(indx, element){
            
            if(vorotaTypeHeightWidthOtkrivanieTypeinstall[typeVorot][height][width][typeOpen][$(element).val()]){
                
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('checked', false);
                $(element).prop('disabled', true);
            }
            
        });
    });
    
    // выбор типа калитки
    $('body').on('click', 'input[name="type_kalitka"]', function(){
        var typeKalitki = $(this).val();
console.log('typeKalitki', typeKalitki);
console.log('valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki]', valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki]);

        $('#height_kalitka option:gt(0)').each(function(indx, element){
            
            if(valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
            }
            
        });
        
        $('#height_kalitka option:first').attr('selected', 'selected');    
    });
    
    
    // выбор высоты калитки
    $('body').on('change', '#height_kalitka', function(){
        var height = $(this).val();
        var width = 100;
        var typeKalitki = $('input[name="type_kalitka"]:checked').val();
        
        $('input[name="type_open_kalitka"]').each(function(indx, element){
            
            if(valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki][height][width][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('checked', false);
                $(element).prop('disabled', true);
            }
            
        });
        
        // $('input[name="type_open_kalitka"]:checked').prop('checked', false);
        // $('input[name="type_install_kalitka"]:checked').prop('checked', false);
    }); 
    //выбор Открывание калитки
    $('body').on('change', 'input[name="type_open_kalitka"]', function(){
        var typeKalitki = $('input[name="type_kalitka"]:checked').val();
        var height = $('#height_kalitka').val();
        var width = $('#width_kalitka').val();
        var typeOpen = $(this).val();
console.log('height', height);
console.log('width', width);
console.log('valitkaTypeHeightWidthOtkrivanieTypeinstall[height]', valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki][height][width]);
        $('input[name="type_install_kalitka"]').each(function(indx, element){
            
            if(valitkaTypeHeightWidthOtkrivanieTypeinstall[typeKalitki][height][width][typeOpen][$(element).val()]){
                
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('checked', false);
                $(element).prop('disabled', true);
            }
            
        });
        
        //$('input[name="type_install_kalitka"]:checked').prop('checked', false);
    });
    // выбор типа калитки
   /* $('body').on('click', 'input[name="type_kalitka"]', function(){
        var typeKalitka = $(this).val();

        $('#height_kalitka option:gt(0)').each(function(indx, element){

            if(find(kalitkaVisota[typeKalitka], $(element).val()) == -1 ){
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });
        
        $('#width_kalitka option:gt(0)').each(function(indx, element){

            if(find(kalitkaWidth[typeKalitka], $(element).val()) == -1 ){
                $(element).prop('disabled', true);
            }
            else{
                $(element).prop('disabled', false);
            }
        });
            
        $('#height_kalitka option:first').attr('selected', 'selected');    
        $('#width_kalitka option:first').attr('selected', 'selected');    

        if(typeKalitka == 'kalitka_standart'){   
            
        }
        else if(typeKalitka == 'kalitka_fit'){
            
        }
        else if(typeKalitka == 'kalitka_otkatnie'){
        }
    });*/
    
    $('#shtanga').on('click', function(){

        /*if($(this).prop('checked')){
            if(!$('input[name="type_shtanga"]:checked').length){
                $('input[name="type_shtanga"]').first().trigger('click');
                //$('input[name="dlina_shtanga"]').first().prop('checked', true);
            }
        }
        else{
            $('input[name="type_shtanga"]').prop('checked', false);
            $('input[name="dlina_shtanga"]').prop('checked', false);
        }*/
        
    });
    
    // зависимость типа штанги от типа ягозы
    $('input[name="egoza_sbb"]').on('click', function(){
        if($(this).prop('checked')){
            $('input[name="type_shtanga"]').prop({'disabled':true, 'checked':false});
            $('input[name="type_shtanga"][value="V"]').prop({'disabled':false, 'checked':true}).trigger('click');
            $('input[name="egoza_pbb"]').prop({'disabled':true, 'checked':false});
        }
        else{
            $('input[name="egoza_pbb"]').prop({'disabled':false, 'checked':false});
            $('input[name="type_shtanga"]').prop({'disabled':false, 'checked':false});
            $('input[name="dlina_shtanga"]').prop({'disabled':false, 'checked':false});
        }
    }); 
    
    $('input[name="egoza_pbb"]').on('click', function(){
        if($(this).prop('checked')){
            $('input[name="type_shtanga"]').prop({'disabled':true, 'checked':false});
            $('input[name="type_shtanga"][value="I"]').prop({'disabled':false, 'checked':true}).trigger('click');
            $('input[name="egoza_sbb"]').prop({'disabled':true, 'checked':false});
        }
        else{
            $('input[name="egoza_sbb"]').prop({'disabled':false, 'checked':false});
            $('input[name="type_shtanga"]').prop({'disabled':false, 'checked':false});
            $('input[name="dlina_shtanga"]').prop({'disabled':false, 'checked':false});
        }
    });
    
    function changeDlinaStangi(){
        var diam = '';
        if( $('input[name="egoza_pbb"]:checked').length > 0){
            diam = $('select[name="diametr_yagozi_pbb[]"]').val();
        }
        else if( $('input[name="egoza_sbb"]:checked').length > 0 ){
            diam = $('select[name="diametr_yagozi_sbb[]"]').val();
        }
        
        var typeStanga = $('input[name="type_shtanga"]:checked').val();
console.log('diam', diam);
console.log('typeStanga', typeStanga);
console.log('diamTypeStangaDlina', diamTypeStangaDlina);

        if(diam && typeStanga){
            $('input[name="dlina_shtanga"]').each(function(indx, element){ 
                if ($(element).val() in diamTypeStangaDlina[diam][typeStanga]){
                   $(element).prop('disabled', false); 
                }
                else{
                    $(element).prop('disabled', true);
                    $(element).prop('checked', false);
                    
                }
            });
            
        }
    }
    
    // выбор типа штанги
    $('input[name="type_shtanga"]').on('click', function(){

        //var typeStanga = $(this).val();
        changeDlinaStangi();

        /*if(typeStanga == 'I'){
            $('#egoza_sbb').prop('disabled', true);
            $('#egoza_sbb').prop('checked', false);
            
            $('#egoza_pbb').prop('disabled', false);
        }
        else{
            $('#egoza_sbb').prop('disabled', false);
            
            $('#egoza_pbb').prop('disabled', true);
            $('#egoza_pbb').prop('checked', false);
        }*/
    
    });
    
    
    //kol_vitkov_yagozi_pbb diametr_yagozi_pbb diametr_yagozi_sbb kol_vitkov_yagozi_sbb 
   
    // выбор диаметра ягозы СББ
    $('body').on('change', '.diametr_yagozi_sbb', function(){
        var diam = $(this).val();
        $nextWrapParams = $(this).closest('.wrap-params').next('.wrap-params');
        
        $nextWrapParams.find('.kol_vitkov_yagozi_sbb option:gt(0)').each(function(indx, element){

            if(yagozaTypeDiametrKolVitkov['СББ'][diam][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
            }
        });

        if( $nextWrapParams.find('.kol_vitkov_yagozi_sbb option:selected').attr('disabled') )
            $nextWrapParams.find('.kol_vitkov_yagozi_sbb option:first').attr('selected', 'selected'); 

        changeDlinaStangi();        
    });

    // выбор диаметра ягозы ПББ - 1 вариант только
    $('body').on('change', '.diametr_yagozi_pbb', function(){
        
        changeDlinaStangi(); 
        /*var diam = $(this).val();
        $nextWrapParams = $(this).closest('.wrap-params').next('.wrap-params');
        
        $nextWrapParams.find('.kol_vitkov_yagozi_pbb option:gt(0)').each(function(indx, element){

            if(yagozaTypeDiametrKolVitkov['ПББ'][diam][$(element).val()]){
                $(element).prop('disabled', false);
            }
            else{
                $(element).prop('disabled', true);
            }
        });

        if( $nextWrapParams.find('.kol_vitkov_yagozi_pbb option:selected').attr('disabled') )
            $nextWrapParams.find('.kol_vitkov_yagozi_pbb option:first').attr('selected', 'selected'); */   
    });

    $('body').on('click', '#calculate', function (e) {
        e.preventDefault();
        
        /*if( $(this).hasClass('disabled') )
            return false;*/
        
        var summStoron = 0;
        $('input.storona').each(function(indx, element){
            summStoron += $(element).val()*1;
        });
        
        // периметр
        var perimetr = $('#perimetr').val()*1;
        if(perimetr < 1){
            //то равен сумме сторон
            $('#perimetr').val(summStoron);
        }
        
        // цвет
        if( $('#other_color').is(':checked') ){
            var colorYour = $('#color_your').val();
    console.log('colorYour', colorYour);

            $('#comment_color').val('#Нестандартный цвет# ' + colorYour + '. Заполните характеристики.');
        }
        else{
            $('#comment_color').val('');
        }
        
        
        var cntStoron = $('.wrap-storona').length;
        var self = this,
            $self = $(self),
            $form = $self.parents('form');
        
        var fd = new FormData($form[0]);
        //fd.append( 'upload', $form.find('input[type="file"]')[0].files[0] );
        fd.append( 'summstoron', summStoron );
        fd.append( 'cntStoron', cntStoron );
        if (checkreq(self) == 0) {
            $('.errortext').html('');
            
            $.ajax({
                url: 'calc.php',
                dataType : 'html',//'json',
                data: fd,//$form.serialize(),//
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(data) {
                    if(colorYour){
                        data = data.replace(new RegExp('RAL-6005', 'g'), 'RAL-'+colorYour);
                        $('.text-your-color').removeClass('hidden');
                    }
                    else{
                        $('.text-your-color').addClass('hidden');
                    }
                    $('.result').html(data); 
                    $('.order-form ').removeClass('hidden');
                    $('.result-order').addClass('hidden');
                    
                    
                    // if (data.error) {   
                    // }
                    // if (data.success) {
                    // }
                },
                error: function(xhr, str){
                    console.log('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }
        else{
            $("html:not(:animated),body:not(:animated)").animate({scrollTop: $('.calculator').offset().top - 46}, 500);
        }
    });
    
    $('#order_submit').on('click', function (e) {
         e.preventDefault();

        var self = this,
            $self = $(self);
        
        var $formProps = $('#order_form');
        
        // var fd = new FormData($formProps[0]);
        // fd.append( 'ELEMENTS', $('#elements').val() );
        
        var formData = $formProps.serialize();
console.log('formData',formData);

        formData += '&ELEMENTS='+$('#elements').val();
console.log('formData',formData);
        if (checkreq(self) == 0) {
            $('.errortext').html('');
            
            $.ajax({
                url: 'script.php',
                dataType : 'json',//'html',
                data: formData,//fd,//
                type: 'POST',
                //processData: false,
                //contentType: false,
                success: function(data) {
                    $('.result-odrer-errortext').html('');
                    if(data.result == 'Y'){
                        $('.result-order').html(data.message);
                        $('.order-form').addClass('hidden'); 
                        $('.result-order').removeClass('hidden');
                    }
                    else{
                        var text = data.message;
                        if(data.err)
                            text = text + ' ' + data.err;
                        $('.result-odrer-errortext').html(text); 
                    }
                    

                },
                error: function(xhr, str){
                    console.log('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }
        else{
            $("html:not(:animated),body:not(:animated)").animate({scrollTop: $('.calculator').offset().top - 46}, 500);
        }
    });
    
    function checkreq(button) {
        var error = 0;
        $(button).parents('form').find('.check').each(function () {
            var input = $(this);
            var error2 = 0;
            $(input).removeClass('error');
            
            var input_name = $(this).attr('name');
            
            if ($(input).is('input')) {
                
                if( input_name == 'perimetr' ||
                    input_name.indexOf('storona') > -1 ||
                         input_name == 'kol_kalitka' && $('#kalitka').is(':checked') ||
                         input_name == 'kol_vorot' && $('#vorota').is(':checked') ||
                         input_name == 'egoza_perimetr' && $('#egoza').is(':checked') || 
                         input_name == 'kozirek_perimetr' && $('#kozirek').is(':checked') ||
                         input_name == 'egoza_perimetr_sbb[]' && $('#egoza_sbb').is(':checked') ||
                         input_name == 'egoza_perimetr_pbb[]' && $('#egoza_pbb').is(':checked')
                    )
                {
                    if ($(this).val() < 1) {
                        error2 = 1;
                        $(this).addClass('error');
                    }else{
                        $(this).removeClass('error');
                    }
                }
                /*else if ($(this).val().length < 1) {
                    error2 = 1;
                    $(this).addClass('error');
                }else{
                    $(this).removeClass('error');
                }*/
            }
            
            
            if ($(this).is('select')) {
console.log('input_name', input_name);
                if( 
                    (input_name == 'height_kalitka' || input_name == 'width_kalitka') && $('#kalitka').is(':checked') ||
                    (input_name == 'height_vorot' || input_name == 'width_vorot') && $('#vorota').is(':checked') ||
                    input_name.indexOf('sechenie_stolba') > -1 || input_name.indexOf('height_paneli') > -1 ||
                    (input_name == 'diametr_yagozi_sbb[]' || input_name == 'kol_vitkov_yagozi_sbb[]') && $('#egoza_sbb').is(':checked') ||
                    (input_name == 'diametr_yagozi_pbb[]' || input_name == 'kol_vitkov_yagozi_pbb[]') && $('#egoza_pbb').is(':checked') ||
                    input_name == 'width'

                  )
                {
                    if ($(this).val() < 1) {
                        error2 = 1;
                    }
                }
                
            }
            if ($(this).is('textarea')) {
                if ($(this).val().length < 2) {
                    error2 = 1;
                }
            }
 
            if ($(this).hasClass('checkboks')) {
                if (!$(this).hasClass('checked')) {
                    if(!$(this).is(':checked')){
                        error2 = 1;
                        $(this).addClass('error');
                    }else{
                        $(this).removeClass('error');
                    }
                } 
            }

            if (error2 == 1) {
                error = 1;
                $(input).addClass('error');
            }
            else{
                $(input).removeClass('error');
                console.log('input', $(input));
            }
        });
        
        // тип панели
        if( $('input[name="type_panel"]:checked').length == 0 ){
            $('#input_wrap_type_panel').addClass('error');
            error = 1;
        }
        else{
            $('#input_wrap_type_panel').removeClass('error');
        }
            
        // окрашивание
        if( $('input[name="color"]:checked').length == 0 ){
            $('#input_wrap_color').addClass('error');
            error = 1;
        }
        else if($('input[name="color"]:checked').val() == 'other_color' && $('#color_your').val()*1 == 0){
            $('#input_wrap_color').removeClass('error');
            $('#color_your').addClass('error');
        }
        else{
            $('#input_wrap_color').removeClass('error');
            $('#color_your').removeClass('error');
        }
        
        // длина штанги shtanga
        if( $('#shtanga:checked').length == 1 && $('input[name="dlina_shtanga"]:checked').length == 0 ){
            $('#input_wrap_dlina_shtanga').addClass('error');
            error = 1;
        }
        else{
            $('#input_wrap_dlina_shtanga').removeClass('error');
        }
        
        // тип штанги shtanga
        if( $('#shtanga:checked').length == 1 && $('input[name="type_shtanga"]:checked').length == 0 ){
            $('#input_wrap_type_shtanga').addClass('error');
            error = 1;
        }
        else{
            $('#input_wrap_type_shtanga').removeClass('error');
        }

        //открывание ворот 
        if( $('#vorota').is(':checked') &&  $('input[name="type_open_vorot"]:checked').length == 0)
        {
            
            $('#type_open_vorot_vnutrennee').closest('.input-param').addClass('error');
            error = 1;
        }
        else{
            $('#type_open_vorot_vnutrennee').closest('.input-param').removeClass('error');
        }
        
        //установка ворот 
        if( $('#vorota').is(':checked') && $('input[name="type_install_vorot"]:checked').length == 0 ){
            $('#type_install_vorot_pod_betonirovanie').closest('.input-param').addClass('error');
            error = 1;
        }
        else{
            $('#type_install_vorot_pod_betonirovanie').closest('.input-param').removeClass('error');
        }
        
        //открывание калитки
        if( $('#kalitka').is(':checked') && $('input[name="type_open_kalitka"]:checked').length == 0 ) {
            $('#type_open_kalitka_levoe').closest('.input-param').addClass('error');
            error = 1;
        }
        else{
            $('#type_open_kalitka_levoe').closest('.input-param').removeClass('error');
        }
        
        //установка калитки
        if( $('#kalitka').is(':checked') && $('input[name="type_install_kalitka"]:checked').length == 0 ){
            $('#type_install_kalitka_pod_betonirovanie').closest('.input-param').addClass('error');
            error = 1;
        }
        else{
            $('#type_install_kalitka_pod_betonirovanie').closest('.input-param').removeClass('error');
        }
        
        
        if (error == 1) {
            $(button).parents('form').parent().find('.errortext').html('Не заполнены обязательные поля').show();
        }
        return error;
    }
    
    // init
    $('#vorota_standart').trigger('click');
    $('#kalitka_standart').trigger('click');
    
    // декативируем
    //$('input[name="kalitka"]').prop('disabled', true);
    $('input[name="type_kalitka"]').prop('disabled', true);
    $('input[name="kol_kalitka"]').prop('disabled', true);
    $('select[name="height_kalitka"]').attr('disabled', 'disabled'); 
    $('select[name="width_kalitka"]').attr('disabled', 'disabled');
    $('input[name="type_open_kalitka"]').prop('disabled', true);
    $('input[name="type_install_kalitka"]').prop('disabled', true);
    
    //$('input[name="vorota"]').prop('disabled', true);
    $('input[name="type_vorot"]').prop('disabled', true);
    $('input[name="kol_vorot"]').prop('disabled', true);
    $('select[name="height_vorot"]').attr('disabled', 'disabled');
    $('select[name="width_vorot"]').attr('disabled', 'disabled');
    $('input[name="type_open_vorot"]').prop('disabled', true);
    $('input[name="type_install_vorot"]').prop('disabled', true);
    
    
    $('input[name="egoza_perimetr_sbb[]"]').prop('disabled', true);
    $('select[name="diametr_yagozi_sbb[]"]').prop('disabled', true);
    $('select[name="kol_vitkov_yagozi_sbb[]"]').prop('disabled', true);
    
    $('input[name="egoza_perimetr_pbb[]"]').prop('disabled', true);
    $('select[name="diametr_yagozi_pbb[]"]').prop('disabled', true);
    $('select[name="kol_vitkov_yagozi_pbb[]"]').prop('disabled', true);

    $('input[name="type_shtanga"]').prop('disabled', true);
    $('input[name="dlina_shtanga"]').prop('disabled', true);
    
    $('input[name="kozirek_perimetr"]').prop('disabled', true);
    
});

// создаем пустой массив и проверяем поддерживается ли indexOf
if ([].indexOf) {

  var find = function(array, value) {
    return array.indexOf(value);
  }

} else {
  var find = function(array, value) {
    for (var i = 0; i < array.length; i++) {
      if (array[i] === value) return i;
    }

    return -1;
  }

}

var findPos = function(array, value) {
    for (var i = 0; i < array.length; i++) {
        if (value.indexOf(array[i]) > -1) 
            return i;
    }
    return -1;
}
</script>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>