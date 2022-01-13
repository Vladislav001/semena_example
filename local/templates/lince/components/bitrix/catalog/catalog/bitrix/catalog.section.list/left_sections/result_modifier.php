<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['SECTIONS'] as $key => $value)
{
	if ($value['ELEMENT_CNT'] == 0 || $value['DEPTH_LEVEL'] != 1)
	{
		unset($arResult['SECTIONS'][$key]);
		continue;
	}
}