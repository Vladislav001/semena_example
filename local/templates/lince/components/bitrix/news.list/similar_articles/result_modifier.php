<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as $key => $item)
{
	$picture = false;
	if($item['PREVIEW_PICTURE'])
	{
		$picture = $item['PREVIEW_PICTURE'];
	} elseif ($item['DETAIL_PICTURE'])
	{
		$picture = $item['DETAIL_PICTURE'];
	}

	if ($picture)
	{
		$arResult['ITEMS'][$key]['PICTURE'] = CFile::ResizeImageGet($picture['ID'],
			array('width' => IMAGE_PARAMETERS['blog-similar-article']['width'], 'height' => IMAGE_PARAMETERS['blog-similar-article']['height']),
			IMAGE_PARAMETERS['blog-similar-article']['resize_type']);
	}

	$arResult['ITEMS'][$key]['DATE_CREATE'] = FormatDate(array(
		"" => 'j F Y',
	), MakeTimeStamp($item['DATE_CREATE']), time());
}