<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS'] && !empty($arResult["ITEMS_DB"])):?>
    <div class="title-search-result">
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<?
			if ($arItem['TYPE'])
			{
				continue;
			}
			$itemDB = $arResult['ITEMS_DB'][$arItem['ITEM_ID']];
			?>
                <div>
					<?if($category_id === "all"):?>
                        <div class="title-search-all">
                            <a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
                        </div>
					<?else:?>
                        <div class="title-search-item">
                            <input type="hidden" class="js_id" value="<?=$itemDB["ID"]?>">
                            <input type="hidden" class="js_name" value="<?=$itemDB["NAME"]?>">
                            <input type="hidden" class="js_price" value="<?=$itemDB["PRICE"]?>">

                            <? if ($itemDB["PREVIEW_PICTURE"]):?>
                                <a href="<?= $arItem["URL"] ?>" class="title-search-item__img">
                                    <img src="<?= $itemDB["PREVIEW_PICTURE"]['src'] ?>">
                                </a>
							<?endif; ?>

                            <div class="title-search-item__text">
                                <a href="<?=$arItem["URL"]?>" class="title-search-item__link"><?= $arItem["NAME"]?></a>
								<? if ($itemDB['PROPERTY_CML2_ARTICLE_VALUE']):?>
                                    <div class="title-search-item__min">Арт:
                                        <b><?= $itemDB['PROPERTY_CML2_ARTICLE_VALUE'] ?></b></div>
								<? endif; ?>
                            </div>

                            <?if($itemDB['PRICE'] && $itemDB['QUANTITY'] > 0):?>
                                <div class="title-search-item__price">
                                    <?=$itemDB['PRICE']?>₽
                                </div>

                                <input type="hidden" class="js-counter" value="1" name="QUANTITY">
                                <button class="button button--basic js-to-basket" data-id='<?= $itemDB['ID'] ?>'>В корзину</button>
							<? else:?>
                                <div class="title-search-item__price">
                                    Нет в наличии
                                </div>
							<?endif; ?>

                        </div>
					<?endif;?>
                </div>
			<?endforeach;?>
	<?endforeach;?>

    </div><div class="title-search-fader"></div>
<?endif;
?>