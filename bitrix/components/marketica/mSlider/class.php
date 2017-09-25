<? 
    use Bitrix\Main\Loader;
    use Bitrix\Main\Application; 
    use Bitrix\Main\Web\Uri;
     
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    class winVideo extends CBitrixComponent
    {
        
        public function executeComponent()
        {
            $arSection = array();
            
            $arFilter = array('IBLOCK_ID' => 60, "DEPTH_LEVEL" => 1, "ACTIVE" => "Y");
     
            $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
   while ($arSect = $rsSect->GetNext())
   {
    $arSection[$arSect["ID"]] = $arSect;

   }
            $this->arResult = array();
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "SORT", "DATE_ACTIVE_FROM","PREVIEW_PICTURE","IBLOCK_SECTION_ID", "PREVIEW_TEXT","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID"=>60, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, true, $arSelect);
            while($ob = $res->GetNextElement()){ 
             $arFields = $ob->GetFields();  
            
             $arProps = $ob->GetProperties();


if(!empty($arFields["PREVIEW_PICTURE"])){

           
                $arFields["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        }
                $this->arResult[$arFields["IBLOCK_SECTION_ID"]][] = array(
                    "ITEM" => $arFields,
                    "PROPERTIES" => $arProps,
                    );
            }
    $this->arResult["SECTIONS"] = $arSection;
  /*  echo"<pre>";
print_r($this->arResult);
echo"</pre>";*/

            $this->includeComponentTemplate();
        
        }    


        public function onPrepareComponentParams($arParams)
        {
            

            return $arParams;
        }
        
    }
?>