<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as $key => $item)
{
	if($item['PREVIEW_PICTURE'])
	{
		$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($item['PREVIEW_PICTURE']['ID'],
			array('width' => IMAGE_PARAMETERS['advertising']['width'], 'height' => IMAGE_PARAMETERS['advertising']['height']),
			IMAGE_PARAMETERS['advertising']['resize_type']);
	}
}