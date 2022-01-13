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
			array('width' => IMAGE_PARAMETERS['blog-list']['width'], 'height' => IMAGE_PARAMETERS['blog-list']['height']),
			IMAGE_PARAMETERS['blog-list']['resize_type']);
	}

	$arResult['ITEMS'][$key]['DATE_CREATE'] = FormatDate(array(
		"" => 'j F Y',
	), MakeTimeStamp($item['DATE_CREATE']), time());

	if($item['PREVIEW_TEXT'])
	{
		$text = $item['PREVIEW_TEXT'];
	} elseif ($item['DETAIL_TEXT'])
	{
		$text = $item['DETAIL_TEXT'];
	}

	if ($text)
	{
		$text = trim(strip_tags($text));
		$text = str_replace('&nbsp;', '', $text);
		$text  = mb_substr($text, 0, 100);
		$text .= '...';

		$arResult['ITEMS'][$key]['TEXT'] = $text;
	}
}