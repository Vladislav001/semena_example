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

<section class="related">
    <h2 class="related__title">
        Похожие статьи
    </h2>

    <div class="container">
        <ul class="ul related__list">
			<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
                <li class="related__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="a article article--small">
						<? if ($arItem["PICTURE"]):?>
                            <div class="article__image-block">
                                <img src="<?= $arItem["PICTURE"]['src'] ?>" class="article__image" alt="">
                            </div>
						<? endif; ?>
                        <div class="article__content">
                            <div class="article__topper">
                                <div class="article__date"><?=$arItem["DATE_CREATE"]?></div>
                            </div>
                            <h3 class="article__title">
                                <?=$arItem['NAME']?>
                            </h3>
                        </div>
                    </a>
                </li>
			<? endforeach; ?>

        </ul>
    </div>

</section>