<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<article class="item">
    <input type="hidden" class="js_id" value="<?=$arResult["ID"]?>">
    <input type="hidden" class="js_name" value="<?=$arResult["NAME"]?>">
    <input type="hidden" class="js_price" value="<?=$arResult["TOTAL_PRICE"]?>">

    <? if ($arResult['TOTAL_DISCOUNT_PERCENT']): ?>
        <div class="sale-badge sale--item">-<?= $arResult['TOTAL_DISCOUNT_PERCENT'] ?>%</div>
    <? endif; ?>
    <?if($arResult['PICTURE']['src']):?>
        <a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="a item__link">
            <img src="<?= $arResult['PICTURE']['src'] ?>" class="item__image" alt="<?= $arResult['NAME'] ?>">
        </a>
    <?endif;?>
    <a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="a item__name">
        <?= $arResult['NAME'] ?>
    </a>
	<?if($arResult['TOTAL_PRICE'] && $arResult['CATALOG_QUANTITY'] > 0):?>
    <div class="item__total item__total_min">
        <div class="price">
            <?= $arResult['TOTAL_PRICE'] ?>₽
        </div>

    </div>
    <div class="item__total _no-pd">
        <div class="counter">
            <button type="button" class="button counter__button counter__button--decrement js-decrement">-</button>
            <input type="text" class="input counter__field js-counter" value="1" name="QUANTITY">
            <button type="button" class="button counter__button counter__button--increment js-increment">+</button>
        </div>
        <div class="item__cou">шт.</div>
        <button type="button" class="button basket-add js-to-basket" data-id='<?= $arResult['ID'] ?>'>
            <span class="basket-add__title">В корзину</span>
            <span class="basket-add__image">
        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/basket.svg" alt="">
       </span>
        </button>
    </div>

    <?else:?>
    <div class="item__total">
        Нет в наличии
    </div>

    <?
    if ($arResult['CATALOG_QUANTITY'] <= 0)
    {
        $APPLICATION->IncludeComponent('bitrix:catalog.product.subscribe', 'main', array(
            'CUSTOM_SITE_ID' => SITE_ID,
            'PRODUCT_ID' => $arResult['ID'],
            'BUTTON_ID' => $this->GetEditAreaId($arResult['ID']) . '_subscribe',
            'BUTTON_CLASS' => 'button button--basic',
        ), $component, array('HIDE_ICONS' => 'Y'));
    }
    ?>
    <?endif;?>
</article>