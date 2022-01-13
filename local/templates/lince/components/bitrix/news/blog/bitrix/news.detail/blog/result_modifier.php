<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if ($arResult['DETAIL_PICTURE'])
{
	$picture = $arResult['DETAIL_PICTURE'];
} elseif ($arResult['PREVIEW_PICTURE'])
{
	$picture = $arResult['PREVIEW_PICTURE'];
}

if ($picture)
{
	$arResult['PICTURE']['src'] = $picture['SRC']; //*тут не ресайзим вообще фотки
}

$arResult['DATE_CREATE_FORMATTED'] = FormatDate(array(
	"" => 'j F Y',
), MakeTimeStamp($arResult['DATE_CREATE']), time());

if($arResult['DETAIL_TEXT'])
{
	$arResult['TEXT'] = $arResult['DETAIL_TEXT'];
} elseif ($arResult['PREVIEW_TEXT'])
{
	$arResult['TEXT'] = $arResult['PREVIEW_TEXT'];
}