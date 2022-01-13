<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

?>
<a href="<?=$arParams['PATH_TO_BASKET']?>" class="a header-basket__image col">
    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/basket-icon.svg" alt="">
    <span class="header-basket__count"><?=$arResult['PRODUCT_COUNT'] > 0 ? $arResult['PRODUCT_COUNT'] : 0 ?></span>
</a>
<div class="header-basket__info col">
    <p>тов. на сумму</p>
    <div class="price">
		<?= getPrice($arResult["TOTAL_PRICE_RAW"])?>₽
    </div>
</div>