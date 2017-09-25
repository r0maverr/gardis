<?php

  foreach($arResult["SECTIONS"] as $key => $arSection) {
    if($arSection['UF_ICON']!='NULL') {
       $arResult["SECTIONS"][$key]['ICON'] = CFile::GetFileArray($arSection['UF_ICON']);
    }
  }