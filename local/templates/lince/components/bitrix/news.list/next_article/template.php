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
?>

<? foreach ($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <section class="next" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="article next__article">
			<? if ($arItem["PICTURE"]):?>
                <div class="article__image-block next__image">
                    <img src="<?= $arItem["PICTURE"]['src'] ?>" class="article__image" alt="">
                </div>
			<? endif; ?>
            <div class="article__content next__content">
                <h3 class="next__title">
                   <?=$arItem['NAME']?>
                </h3>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="a next__link">Следующая статья</a>
            </div>
        </div>
    </section>
<? endforeach; ?>
