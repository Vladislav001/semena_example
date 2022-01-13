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
if ($arResult['DETAIL_PICTURE'])
{
	$arResult['PICTURES'][] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],
		array('width' => IMAGE_PARAMETERS['catalog-detail']['width'], 'height' => IMAGE_PARAMETERS['catalog-detail']['height']),
		IMAGE_PARAMETERS['catalog-detail']['resize_type']);
} elseif ($arResult['PREVIEW_PICTURE'])
{
	$arResult['PICTURES'][] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'],
		array('width' => IMAGE_PARAMETERS['catalog-detail']['width'], 'height' => IMAGE_PARAMETERS['catalog-detail']['height']),
		IMAGE_PARAMETERS['catalog-detail']['resize_type']);
}

if ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])
{
	foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $value)
	{
		$arResult['PICTURES'][] = CFile::ResizeImageGet($value,
		array('width' => IMAGE_PARAMETERS['catalog-detail']['width'], 'height' => IMAGE_PARAMETERS['catalog-detail']['height']),
		IMAGE_PARAMETERS['catalog-detail']['resize_type']);
	}
}

// для вывода характеристик
$ignoreProps = array(
	'PHOTO',
	'PROMOTION',
	'NEW',
	'TOP_SALES',
	'BUY_WITH_THIS_PRODUCT',
	'BLOG_POST_ID',
	'BLOG_COMMENTS_CNT',
	'CML2_ARTICLE',
	'CML2_TRAITS',
	'CML2_BASE_UNIT',
	'CML2_TAXES',
	'OPISANIE'
);

foreach ($arResult['PROPERTIES'] as $key => $value)
{
	if(!in_array($key, $ignoreProps) && $value['VALUE'] && !is_array($value['VALUE']))
	{
		$arResult['CHARACTERISTICS'][$value['NAME']] = $value['VALUE'];
	}
}