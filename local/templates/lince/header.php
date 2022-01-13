<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;

Loader::includeModule('sale');
Loc::loadMessages(__FILE__);

global $USER;
setCityByGeoInfo();
?>

<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<title><?$APPLICATION->ShowTitle();?></title>

        <?
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/swiper.min.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/form.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/styles.css");
		?>
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

        <header class="header">
            <div class="container">
                <div class="header__row">
                    <div class="header__col header__logo">
                        <a href="/" class="a logo">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/logo.svg" class="logo__image" alt="">
                        </a>
                    </div>
                    <div class="header__order basket-mobile col">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            "header",
                            Array(
                                "HIDE_ON_BASKET_PAGES" => "N",
                                "PATH_TO_AUTHORIZE" => "",
                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                "PATH_TO_ORDER" => SITE_DIR."personal/order/",
                                "PATH_TO_PERSONAL" => SITE_DIR."personal/index.php",
                                "PATH_TO_PROFILE" => SITE_DIR."personal/index.php",
                                "PATH_TO_REGISTER" => SITE_DIR."auth/",
                                "POSITION_FIXED" => "N",
                                "SHOW_AUTHOR" => "N",
                                "SHOW_EMPTY_VALUES" => "Y",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_PRODUCTS" => "N",
                                "SHOW_REGISTRATION" => "N",
                                "SHOW_TOTAL_PRICE" => "Y"
                            )
                        );?>
                    </div>
                    <div class="search search-mobile col">
                        <? $APPLICATION->IncludeComponent("bitrix:search.title", "header", array(
                            "CATEGORY_0" => array(
                                0 => "iblock_1c_catalog",
                            ),
                            "CATEGORY_0_TITLE" => "Каталог",
                            "CATEGORY_0_iblock_catalog" => array(
                                0 => "1",
                            ),
                            "CHECK_DATES" => "N",
                            "CONTAINER_ID" => "title-search-mobile",
                            "INPUT_ID" => "title-search-input-mobile",
                            "NUM_CATEGORIES" => "1",
                            "ORDER" => "date",
                            "PAGE" => "/search/",
                            "SHOW_INPUT" => "Y",
                            "SHOW_OTHERS" => "N",
                            "TOP_COUNT" => "5",
                            "USE_LANGUAGE_GUESS" => "Y",
                            "COMPONENT_TEMPLATE" => "header",
                            "CATEGORY_0_iblock_1c_catalog" => array(
                                0 => "all",
                            )
                        ), false); ?>
                    </div>
                    <button type="button" class="button button--basic js_subscribe button_head button_head_mobile">Получить скидку</button>
                    <div class="header__col header__content">
                        <div class="header__nav">

							<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"header_1",
								Array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "header_1",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(""),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_USE_GROUPS" => "N",
									"ROOT_MENU_TYPE" => "header_1",
									"USE_EXT" => "N"
								)
							);?>

                            <div >
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/map-point.svg"style="float: left">

								<? if (!($_SESSION['USER_GEO_INFO']['CITY_ID'])): ?>
                                    <a data-fancybox data-type="ajax" data-src="/ajax/fancybox/choose_geo.php"
                                       href="javascript:;"
                                       style="float: left">Ваш город не определен</a>
								<? else: ?>
                                    <span style="float: left">Ваш город: </span>
                                    <a data-fancybox data-type="ajax" data-src="/ajax/fancybox/choose_geo.php" href="javascript:;"
                                      style="float: left"><?= $_SESSION['USER_GEO_INFO']['CITY_NAME'] ?>
                                    </a>
								<? endif; ?>

                            </div>

                            <ul class="ul header-auth">
								<?if ($USER->IsAuthorized()):?>
                                    <li class="li header-auth__item"><a href="/personal/" class="a header-auth__link"><?=Loc::getMessage("HEADER.PERSONAL_AREA")?></a></li>
                                    <li class="li header-auth__item"><a href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), [
												"login",
												"logout",
												"register",
												"forgot_password",
												"change_password"]
										);?>" class="a header-auth__link"><?=Loc::getMessage("HEADER.LOGOUT")?></a></li>
                                <?else:?>
                                    <li class="li header-auth__item"><a href="/auth/registration.php" class="a header-auth__link"><?=Loc::getMessage("HEADER.REGISTRATION")?></a></li>
                                    <li class="li header-auth__item"><a href="/auth/" class="a header-auth__link"><?=Loc::getMessage("HEADER.AUTHORIZATION")?></a></li>
								<?endif;?>
                            </ul>

                        </div>
                        <div class="header-additional row">

							<? $APPLICATION->IncludeComponent("bitrix:search.title", "header", array(
									"CATEGORY_0" => array(
										0 => "iblock_1c_catalog",
									),
									"CATEGORY_0_TITLE" => "Каталог",
									"CATEGORY_0_iblock_catalog" => array(
										0 => "1",
									),
									"CHECK_DATES" => "N",
									"CONTAINER_ID" => "title-search",
									"INPUT_ID" => "title-search-input",
									"NUM_CATEGORIES" => "1",
									"ORDER" => "date",
									"PAGE" => "/search/",
									"SHOW_INPUT" => "Y",
									"SHOW_OTHERS" => "N",
									"TOP_COUNT" => "5",
									"USE_LANGUAGE_GUESS" => "Y",
									"COMPONENT_TEMPLATE" => "header",
									"CATEGORY_0_iblock_1c_catalog" => array(
										0 => "all",
									)
								), false); ?>

                            <div class="contacts col">
								<? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/header_contacts.php"
								)); ?>
                            </div>

                            <div class="col">
                                <button type="button" class="button button--basic js_subscribe button_head">Получить скидку</button>
                            </div>

                            <div class="header__order col">
								<?$APPLICATION->IncludeComponent(
									"bitrix:sale.basket.basket.line",
									"header",
									Array(
										"HIDE_ON_BASKET_PAGES" => "N",
										"PATH_TO_AUTHORIZE" => "",
										"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
										"PATH_TO_ORDER" => SITE_DIR."personal/order/",
										"PATH_TO_PERSONAL" => SITE_DIR."personal/index.php",
										"PATH_TO_PROFILE" => SITE_DIR."personal/index.php",
										"PATH_TO_REGISTER" => SITE_DIR."auth/",
										"POSITION_FIXED" => "N",
										"SHOW_AUTHOR" => "N",
										"SHOW_EMPTY_VALUES" => "Y",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_PERSONAL_LINK" => "N",
										"SHOW_PRODUCTS" => "N",
										"SHOW_REGISTRATION" => "N",
										"SHOW_TOTAL_PRICE" => "Y"
									)
								);?>
                            </div>

                        </div>
                    </div>
                    <div class="header__col menu-btn">
                        <div class="menu-btn__burger"></div>
                    </div>
                </div>
            </div>
            <nav class="nav">
                <div class="container">

					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"header_2",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "header_2",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "header_2",
							"USE_EXT" => "N"
						)
					);?>

                </div>
            </nav>
            <div class="header-mobile">

				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"header_1_mobile",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "header_1",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(""),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "N",
						"ROOT_MENU_TYPE" => "header_1",
						"USE_EXT" => "N"
					)
				);?>

                <ul class="ul header-mobile__auth">
                    <?if ($USER->IsAuthorized()):?>
                        <li class="li"><a href="/personal/" class="a"><?=Loc::getMessage("HEADER.PERSONAL_AREA")?></a></li>
                        <li class="li"><a href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), [
									"login",
									"logout",
									"register",
									"forgot_password",
									"change_password"]
							);?>" class="a"><?=Loc::getMessage("HEADER.LOGOUT")?></a></li>
                    <?else:?>
                        <li class="li"><a href="/auth/registration.php" class="a"><?=Loc::getMessage("HEADER.REGISTRATION")?></a></li>
                        <li class="li"><a href="/auth/" class="a"><?=Loc::getMessage("HEADER.AUTHORIZATION")?></a></li>
					<?endif;?>
                </ul>

                <div class="header-mobile__additional">
                    <div class="contacts col">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/header_contacts.php"
                        )); ?>
                    </div>
                    <?/*
                    <div class="col">
                        <button type="button" class="button button--basic js_subscribe button_head">Получить скидку</button>
                    </div>
*/?>
                </div>
            </div>
        </header>

        <main class="main">

			<? if ($APPLICATION->GetCurPage(false) != '/'): ?>
            <div class="breadcrumbs">
                <div class="container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"header",
						Array(
							"PATH" => "",
							"SITE_ID" => "s1",
							"START_FROM" => "0"
						)
					);?>
                </div>
            </div>
            <?endif;?>
            <div class="container">
