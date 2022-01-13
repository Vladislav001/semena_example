<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<? if ($arResult["ITEMS"]): ?>
	<? foreach ($arResult["ITEMS"] as $arItem): ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
        <article class="best col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="best__link">
                <img src="<?= $arItem['PREVIEW_PICTURE']['src'] ?>" class="best__image" alt="">
            </a>
        </article>
	<? endforeach; ?>
<? endif; ?>