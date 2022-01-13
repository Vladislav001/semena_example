<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/plugins/lightgallery/lightgallery.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/plugins/lightgallery/lightgallery-bundle.min.css");
$this->addExternalJs(SITE_TEMPLATE_PATH ."/assets/plugins/lightgallery/lightgallery.min.js");
?>

    <section class="catalog">
        <h1 class="h1 detail__title js_name">
            <?= $arResult['NAME'] ?>
        </h1>
        <div class="page catalog__detail">

            <section class="content catalog__content col">
                <div class="item-gallery">
                    <? if ($arResult['PICTURES']): ?>
                        <div class="swiper-container item-gallery__slider">

                            <div class="swiper-wrapper">
                                <? foreach ($arResult['PICTURES'] as $value): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $value['src'] ?>" alt=""/>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>

                        <div thumbsSlider class="swiper-container item-gallery__thumbs">
                            <div class="swiper-wrapper" id="lightgallery">
                                <? foreach ($arResult['PICTURES'] as $value): ?>
                                    <a href="<?= $value['src'] ?>" class="swiper-slide">
                                        <img src="<?= $value['src'] ?>" alt=""/>
                                    </a>
                                <? endforeach; ?>
                            </div>
                        </div>
                    <? endif; ?>
                    <? if ($arResult['TOTAL_DISCOUNT_PERCENT']): ?>
                        <div class="sale-badge sale--item sale-badge--red">
                            -<?= $arResult['TOTAL_DISCOUNT_PERCENT'] ?>%
                        </div>
                    <? endif; ?>


                </div>
                <div class="item-tabs">
                    <ul class="ul item-tabs__nav">

						<? if ($arResult['DETAIL_TEXT']): ?>
                            <li class="item-tabs__tab">
                                <span data-tab="tab-1" class="item-tabs__link active">Описание</span>
                            </li>
						<? endif; ?>

						<? if ($arResult['CHARACTERISTICS']): ?>
                            <li class="item-tabs__tab">
                               <span data-tab="tab-2"
                                     class="item-tabs__link <?= !$arResult['DETAIL_TEXT'] ? 'active' : '' ?>">Характеристики</span>
                            </li>
						<? endif; ?>

                        <li class="item-tabs__tab">
                           <span data-tab="tab-3"
                                 class="item-tabs__link <?= !$arResult['DETAIL_TEXT'] && !$arResult['CHARACTERISTICS'] ? 'active' : '' ?>">Отзывы</span>
                        </li>

                    </ul>
                    <div class="item-tabs__content">

						<? if ($arResult['DETAIL_TEXT']): ?>
                            <div id="tab-1" class="item-tabs__pane active">
                                <p class="item-tabs__description">
									<?= $arResult['DETAIL_TEXT'] ?>
                                </p>
                            </div>
						<? endif; ?>

						<? if ($arResult['CHARACTERISTICS']): ?>
                            <div id="tab-2" class="item-tabs__pane <?= !$arResult['DETAIL_TEXT'] ? 'active' : '' ?>">
                                <ul class="ul properties">

									<? foreach ($arResult['CHARACTERISTICS'] as $name => $value): ?>
                                        <li class="properties__line">
                                            <div class="properties__left">
                                                <span><?= $name ?></span>
                                            </div>
                                            <div class="properties__right">
                                                <span><?= $value ?></span>
                                            </div>
                                        </li>
									<? endforeach; ?>

                                </ul>
                            </div>
						<? endif; ?>

                        <div id="tab-3"
                             class="item-tabs__pane <?= !$arResult['DETAIL_TEXT'] && !$arResult['CHARACTERISTICS'] ? 'active' : '' ?>">
							<? $APPLICATION->IncludeComponent("bitrix:catalog.comments", "product", array(
									"ELEMENT_ID" => $arResult['ID'],
									"ELEMENT_CODE" => "",
									"IBLOCK_ID" => $arParams['IBLOCK_ID'],
									"SHOW_DEACTIVATED" => $arParams['SHOW_DEACTIVATED'],
									"URL_TO_COMMENT" => "",
									"WIDTH" => "",
									"COMMENTS_COUNT" => "10",
									"BLOG_USE" => 'Y',
									"FB_USE" => 'Y',
									"FB_APP_ID" => $arParams['FB_APP_ID'],
									"VK_USE" => 'N',
									"VK_API_ID" => $arParams['VK_API_ID'],
									"CACHE_TYPE" => $arParams['CACHE_TYPE'],
									"CACHE_TIME" => $arParams['CACHE_TIME'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									"BLOG_TITLE" => "",
									"BLOG_URL" => $arParams['BLOG_URL'],
									"PATH_TO_SMILE" => "",
									"EMAIL_NOTIFY" => $arParams['BLOG_EMAIL_NOTIFY'],
									"AJAX_POST" => "Y",
									"SHOW_SPAM" => "Y",
									"SHOW_RATING" => "N",
									"FB_TITLE" => "",
									"FB_USER_ADMIN_ID" => "",
									"FB_COLORSCHEME" => "light",
									"FB_ORDER_BY" => "reverse_time",
									"VK_TITLE" => "",
									"TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME']
								), $component, array("HIDE_ICONS" => "Y")); ?>
                        </div>
                    </div>
                </div>

                <aside class="aside catalog__aside col">
                    <div class="detail">
                        <div class="detail__block aside-filter__block">
                            <input type="hidden" class="js_id" value="<?=$arResult["ID"]?>">
                            <input type="hidden" class="js_name" value="<?=$arResult["NAME"]?>">
                            <input type="hidden" class="js_price" value="<?=$arResult["TOTAL_PRICE"]?>">


                            <? if ($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']): ?>
                                <p class="detail__line detail__number">
                                    <?= $arResult['PROPERTIES']['CML2_ARTICLE']['NAME'] ?>:
                                    <strong><?= $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'] ?></strong>
                                </p>
                            <? endif; ?>

                            <?if($arResult['TOTAL_PRICE'] && $arResult['CATALOG_QUANTITY'] > 0):?>
                            <div class="available">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/check.svg" alt="">
                                <span>В наличии</span>
                            </div>

                            <div class="detail__row">
                                <div class="price">
                                    <?= $arResult['TOTAL_PRICE'] ?>₽
                                </div>

                            </div>

                            <div class="detail__row">
                                <div class="counter">
                                    <button type="button"
                                            class="button counter__button counter__button--decrement js-decrement">-
                                    </button>
                                    <input type="text" class="input counter__field js-counter" value="1" name="QUANTITY">
                                    <button type="button"
                                            class="button counter__button counter__button--increment js-increment">+
                                    </button>
                                </div>
                                <button type="button" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                                        class="button button--basic detail__basket js-to-basket"
                                        data-id='<?= $arResult['ID'] ?>'>
                                    <?= GetMessage("CATALOG_BUY") ?>
                                </button>
                            </div>

                            <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                            <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                                   value="<? echo $arResult["ID"] ?>">


                        </div>
                        <?else:?>
                            <div class="available">
                                <span>Нет в наличии</span>
                            </div>

                            <?
                            if ($arResult['CATALOG_QUANTITY'] <= 0)
                            {
                                $APPLICATION->IncludeComponent('bitrix:catalog.product.subscribe', 'main', array(
                                    'CUSTOM_SITE_ID' => SITE_ID,
                                    'PRODUCT_ID' => $arResult['ID'],
                                    'BUTTON_ID' => $this->GetEditAreaId($arResult['ID']) . '_subscribe',
                                    'BUTTON_CLASS' => 'button button--basic detail__basket',
                                ), $component, array('HIDE_ICONS' => 'Y'));
                            }
                            ?>
                        <?endif;?>

                        <ul class="ul detail__links">
                            <li class="item-links__tab">
                                <a href="/vopros-otvet/" class="a detail__link">Как оформить заказ?</a>
                            </li>
                            <li class="item-links__tab">
                                <a href="/vopros-otvet/" class="a detail__link">Вопрос-ответ</a>
                            </li>
                        </ul>

                        <ul class="ul conditions">
                            <li class="conditions__item">
                                <div class="condition__left">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/delivery.svg"
                                         class="conditions__image" alt="">
                                </div>
                                <div class="conditions__content">
                                    <h3 class="conditions__title">
                                        Доставка
                                    </h3>
                                    <p class="conditions__text">
                                        Доставка по всей России и страны СНГ
                                    </p>
                                </div>
                            </li>
                            <li class="conditions__item">
                                <div class="condition__left">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/wallet.svg"
                                         class="conditions__image" alt="">
                                </div>
                                <div class="conditions__content">
                                    <h3 class="conditions__title">
                                        Оплата
                                    </h3>
                                    <p class="conditions__text">
                                        Банковской картой <br>
                                        Наложенным платежом <br>
                                        Сумма минимального заказа 300 руб.
                                    </p>
                                </div>
                            </li>
                        </ul>

                    </div>
                </aside>
            </section>



        </div>
    </section>


<?
global $arrFilter;
$arrFilter = array("ID" => $arResult['PROPERTIES']['BUY_WITH_THIS_PRODUCT']['VALUE']);

$APPLICATION->IncludeComponent("bitrix:catalog.section", "swiper", array(
	"ACTION_VARIABLE" => "action",
	"ADD_PICT_PROP" => "-",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"ADD_SECTIONS_CHAIN" => "N",
	"ADD_TO_BASKET_ACTION" => "ADD",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"BACKGROUND_IMAGE" => "-",
	"BASKET_URL" => "/personal/cart/",
	"BROWSER_TITLE" => "-",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"CACHE_TIME" => "259200",
	"CACHE_TYPE" => "A",
	"COMPATIBLE_MODE" => "Y",
	"CONVERT_CURRENCY" => "N",
	"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
	"DETAIL_URL" => "",
	"DISABLE_INIT_JS_IN_COMPONENT" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"DISPLAY_COMPARE" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_ORDER2" => "desc",
	"ENLARGE_PRODUCT" => "STRICT",
	"FILTER_NAME" => "arrFilter",
	"HIDE_NOT_AVAILABLE" => "N",
	"HIDE_NOT_AVAILABLE_OFFERS" => "N",
	"IBLOCK_ID" => IBLOCK_CATALOG,
	"IBLOCK_TYPE" => "1c_catalog",
	"INCLUDE_SUBSECTIONS" => "Y",
	"LABEL_PROP" => array(),
	"LAZY_LOAD" => "N",
	"LINE_ELEMENT_COUNT" => "",
	"LOAD_ON_SCROLL" => "N",
	"MESSAGE_404" => "",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_BTN_SUBSCRIBE" => "Подписаться",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"META_DESCRIPTION" => "-",
	"META_KEYWORDS" => "-",
	"OFFERS_FIELD_CODE" => array(
		"",
		""
	),
	"OFFERS_LIMIT" => "5",
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_FIELD2" => "id",
	"OFFERS_SORT_ORDER" => "asc",
	"OFFERS_SORT_ORDER2" => "desc",
	"PAGER_BASE_LINK_ENABLE" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_TITLE" => "Товары",
	"PAGE_ELEMENT_COUNT" => "999",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRICE_CODE" => array("BASE"),
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
	"PRODUCT_DISPLAY_MODE" => "N",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
	"PRODUCT_SUBSCRIPTION" => "Y",
	"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
	"RCM_TYPE" => "personal",
	"SECTION_CODE" => "",
	"SECTION_ID" => "",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SECTION_URL" => "",
	"SECTION_USER_FIELDS" => array(
		"",
		""
	),
	"SEF_MODE" => "N",
	"SET_BROWSER_TITLE" => "N",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "Y",
	"SET_META_KEYWORDS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"SHOW_404" => "N",
	"SHOW_ALL_WO_SECTION" => "N",
	"SHOW_CLOSE_POPUP" => "N",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_FROM_SECTION" => "N",
	"SHOW_MAX_QUANTITY" => "N",
	"SHOW_OLD_PRICE" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"SHOW_SLIDER" => "Y",
	"SLIDER_INTERVAL" => "3000",
	"SLIDER_PROGRESS" => "N",
	"TEMPLATE_THEME" => "blue",
	"USE_ENHANCED_ECOMMERCE" => "N",
	"USE_MAIN_ELEMENT_SECTION" => "N",
	"USE_PRICE_COUNT" => "N",
	"USE_PRODUCT_QUANTITY" => "N",
	"SECTION_CLASS" => 'related',
	"H2_CLASS" => 'related__title',
	"H2_TEXT" => 'С этим товаром покупают',
)); ?>

<script>
    lightGallery(document.getElementById("lightgallery"), {
        speed: 500,
        mobileSettings: {
            controls: true,
            showCloseIcon: true,
            download: false,
            rotate: false
        }
    });
</script>
