<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);
?>
</div>
</div>
<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__row row">


                <div class="footer__col col">
					<?
//                    $APPLICATION->IncludeComponent(
//						"lince:main.feedback",
//						"footer",
//						Array(
//							"EMAIL_TO" => "info@semgrand.ru",
//							"EVENT_MESSAGE_ID" => array(),
//							"OK_TEXT" => "Спасибо, ваше сообщение принято.",
//							"REQUIRED_FIELDS" => array("NAME","PHONE","EMAIL","MESSAGE"),
//							"USE_CAPTCHA" => "Y",
//							"AJAX_MODE" => "Y",
//						)
//					);
                    ?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
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
                <div class="footer__col col">

                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
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
                </div>
                <div class="footer__col col">

                    <div class="footer__contacts">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/footer_contacts_1.php"
                        )); ?>
                    </div>

                    <div class="footer__contacts">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/footer_contacts_2.php"
                        )); ?>
                    </div>

                    <div class="footer__social">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/footer_social.php"
                        )); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="footer__copyright">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/footer_copyright.php"
			)); ?>
        </div>

        <div class="footer__group">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/header_pay.php"
            )); ?>
        </div>
    </div>
</footer>

<?
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery-3.5.1.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/swiper.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.umd.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/scripts.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/custom.js");
?>

<? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
	"AREA_FILE_SHOW" => "file",
	"AREA_FILE_SUFFIX" => "inc",
	"EDIT_TEMPLATE" => "",
	"PATH" => "/include/yandex_metrika.php"
)); ?>
	</body>
</html>