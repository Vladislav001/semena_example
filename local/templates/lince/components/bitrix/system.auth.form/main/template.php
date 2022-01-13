<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/**
 * Bitrix vars
 *
 * @var CBitrixComponent         $component
 * @var CBitrixComponentTemplate $this
 * @var array                    $arParams
 * @var array                    $arResult
 * @var array                    $arLangMessages
 * @var array                    $templateData
 *
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var string                   $parentTemplateFolder
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<?if($_GET['change_password'] && $_GET['USER_CHECKWORD']):?>
    <? $APPLICATION->IncludeComponent("bitrix:main.auth.changepasswd", "main", Array(

    )); ?>
<?elseif($_GET['confirm_registration'] && $_GET['confirm_user_id']):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.confirmation",
		"main",
		Array(
			"CONFIRM_CODE" => "confirm_code",
			"LOGIN" => "login",
			"USER_ID" => "confirm_user_id"
		)
	);?>
<?else:?>
    <?
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
        ShowMessage($arResult['ERROR_MESSAGE']);
    ?>

    <form  action="<?=$arResult["AUTH_URL"]?>" name="system_auth_form<?=$arResult["RND"]?>" class="form" method="post">
        <?if($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>

        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />

        <div class="h2">Войти в личный кабинет</div>
        <div class="form__item">
            <input type="text"
                   name="USER_LOGIN"
                   maxlength="50"
                   value="<?= $_POST["USER_LOGIN"] ?>"
                   placeholder="<?=Loc::getMessage("AUTH_LOGIN")?>"
                   class="input" required>
        </div>

        <div class="form__item">
            <input name="USER_PASSWORD" type="password" class="input" placeholder="<?=Loc::getMessage("AUTH_PASSWORD")?>" required>

            <?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                <div class="bx-auth-secure-icon"></div>
            </span>
                <noscript>
            <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
            </span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                </script>
            <?endif?>
        </div>

	    <?php if ($arResult["STORE_PASSWORD"] == "Y"):?>
            <div class="form__radio-group" data-role="container-personal">
                <input type="checkbox" class="form__radio" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" data-role="check-personal">
                <label for="USER_REMEMBER_frm" class="form__radio-label"></label>
                <div class="form__radio-desc" data-role="text-personal">Запомнить меня на этом компьютере</div>
            </div>
	    <?endif?>

        <input type="submit" name="Login" class="button button--basic form__submit" value="<?=Loc::getMessage("AUTH_LOGIN_BUTTON")?>" />

        <div class="form__radio-group form__radio-group_nom">
            <a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>" class="link_green">Забыли свой пароль?</a>
            <a href="<?= $arResult["AUTH_REGISTER_URL"] ?>" class="link_green">Создать новый аккаунт</a>
        </div>
    </form>
<?endif;?>