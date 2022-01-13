<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["PRICES"] as $code => $arPrice)
{
	if ($arPrice["CAN_ACCESS"])
	{
		$arResult['TOTAL_PRICE'] = getPrice($arPrice["DISCOUNT_VALUE"]);
		$arResult['TOTAL_DISCOUNT_PERCENT'] = $arPrice["DISCOUNT_DIFF_PERCENT"];
	}
}

$arResult['PICTURES'] = array();
if ($arResult['PREVIEW_PICTURE'])
{
	$arResult['PICTURE'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'],
		array('width' => IMAGE_PARAMETERS['catalog-swiper']['width'], 'height' => IMAGE_PARAMETERS['catalog-swiper']['height']),
		IMAGE_PARAMETERS['catalog-swiper']['resize_type']);
} elseif ($arResult['DETAIL_PICTURE'])
{
	$arResult['PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],
		array('width' => IMAGE_PARAMETERS['catalog-swiper']['width'], 'height' => IMAGE_PARAMETERS['catalog-swiper']['height']),
		IMAGE_PARAMETERS['catalog-swiper']['resize_type']);
}