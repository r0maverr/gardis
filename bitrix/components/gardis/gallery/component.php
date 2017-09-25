<?php

  if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

  if(!CModule::IncludeModule("iblock")) {
    return;
  }

  if(!isset($arParams["CACHE_TIME"])) {
  	$arParams["CACHE_TIME"] = 36000000;
  }
  $arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
  $arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
  $arParams["GALLERY_STYLE"] = intval($arParams["GALLERY_STYLE"]);
  if (!in_array($arParams["GALLERY_STYLE"], array(1, 2))) {
    $arParams["GALLERY_STYLE"] = 1;
  }

  if (!$arParams["IBLOCK_ID"] || !$arParams["SECTION_ID"]) {
    return;
  }

  $arResult['PREVIEW_WIDTH'] = 174;
  $arResult['PREVIEW_HEIGHT'] = 111;

  if ($this->StartResultCache(false, array(($arParams["CACHE_GROUPS"]==="N" ? false: $USER->GetGroups()), $arParams["IBLOCK_ID"], $arParams["SECTION_ID"], $arParams["GALLERY_STYLE"]))) {
    $arSort = array(
      "sort" => "asc"
    );
    $arFilter = array(
      'IBLOCK_ID' => $arParams["IBLOCK_ID"],
      'SECTION_ID' => $arParams["SECTION_ID"],
      'INCLUDE_SUBSECTIONS' => 'Y',

    );
    $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE');
    $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
    $arResult['ITEMS'] = array();
    while ($row = $res->Fetch()) {
      if ($row['DETAIL_PICTURE']) {
        $row['DETAIL_PICTURE'] = CFile::GetFileArray($row['DETAIL_PICTURE']);
        $row['PREVIEW'] = createThumbnailExactSize($row['DETAIL_PICTURE'], $arResult['PREVIEW_WIDTH'], $arResult['PREVIEW_HEIGHT']);
      }
      $arResult['ITEMS'][] = $row;
    }

    $this->IncludeComponentTemplate();
  }
