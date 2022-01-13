<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

Loader::includeModule("iblock");
Loader::includeModule("sale");

$arElementID = array();

foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
{
	foreach($arCategory["ITEMS"] as $i => $arItem)
	{
		if(isset($arItem["ITEM_ID"]) && $arItem['PARAM2'] == IBLOCK_CATALOG)
		{
			$arElementID[] = $arItem["ITEM_ID"];
		}
	}
}

if (!$arElementID)
{
	return;
}

$resElements = CIBlockElement::GetList(array(), array(
	"ID" => $arElementID,
	"IBLOCK_ID" => IBLOCK_CATALOG,
), false, false, array(
	"ID",
	"IBLOCK_ID",
	"NAME",
	"PREVIEW_PICTURE",
	"PROPERTY_CML2_ARTICLE"
));

while ($arElement = $resElements->GetNext())
{
	$arElement['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arElement['PREVIEW_PICTURE'],
		array('width' => IMAGE_PARAMETERS['element-search-title']['width'], 'height' => IMAGE_PARAMETERS['element-search-title']['height']),
		IMAGE_PARAMETERS['element-search-title']['resize_type']);

	$arPrice = CCatalogProduct::GetOptimalPrice($arElement['ID']);
	$arElement['PRICE'] = getPrice($arPrice['DISCOUNT_PRICE']);

	$arCatalogProduct = CCatalogProduct::GetByID($arElement['ID']);
	$arElement['QUANTITY'] = $arCatalogProduct['QUANTITY'];

	$arResult["ITEMS_DB"][$arElement['ID']] = $arElement;
}