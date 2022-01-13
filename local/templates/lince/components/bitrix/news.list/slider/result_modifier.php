<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if(!$arResult["ITEMS"])
{
	return;
}

foreach ($arResult["ITEMS"] as $key => &$arItem)
{
	$arResult["ITEMS"][$key]['DESKTOP_PICTURE'] = CFile::GetFileArray($arItem['PROPERTIES']['DESKTOP_PICTURE']['VALUE']);
	$arResult["ITEMS"][$key]['MOBILE_PICTURE'] = CFile::GetFileArray($arItem['PROPERTIES']['MOBILE_PICTURE']['VALUE']);
}