<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['SECTIONS'] as $key => $value)
{
	if ($value['ELEMENT_CNT'] == 0)
	{
		unset($arResult['SECTIONS'][$key]);
		continue;
	}
}

$cp = $this->__component;

if (is_object($cp))
{
	$sectionsData = array();

	foreach ($arResult['SECTIONS'] as $section)
	{
		$sectionsData[$section['SECTION_PAGE_URL']] = $section;
	}

	$cp->arResult['SECTIONS_DATA'] = $sectionsData;
	$cp->SetResultCacheKeys(array('SECTIONS_DATA'));
}