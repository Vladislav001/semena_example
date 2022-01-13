<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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

<?if($USER->IsAuthorized()):?>
    <p><?=GetMessage("MAIN_REGISTER_AUTH")?></p>
<?elseif($_GET['success']):?>
    <p><?=GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?else:?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form" name="regform" enctype="multipart/form-data">
    <?
    if($arResult["BACKURL"] <> ''):
        ?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?
    endif;
    ?>
    <div class="h2">Зарегистрироваться</div>

	<?
	if (count($arResult["ERRORS"]) > 0):
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0)
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

		ShowError(implode("<br />", $arResult["ERRORS"]));
		?>
	<?endif?>

        <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
        <td><?
            switch ($FIELD)
            {
                case "PASSWORD":
                    ?>
                <div class="form__item">
                    <input id="name" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" type="password" class="input" autocomplete="off" placeholder="<?=Loc::getMessage("REGISTER_FIELD_" . $FIELD)?>*" required>
                </div>

                <?if($arResult["SECURE_AUTH"]):?>
                    <span class="bx-auth-secure" id="bx_auth_secure" title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                     </span>
                    <noscript>
                        <span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                        </span>
                    </noscript>
                    <script type="text/javascript">
                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                    </script>
                <?endif?>

                    <?
                    break;
                case "CONFIRM_PASSWORD":
                    ?>
                <div class="form__item">
                    <input id="name" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" type="password" class="input" autocomplete="off" placeholder="<?=Loc::getMessage("REGISTER_FIELD_" . $FIELD)?>*" required>
                </div>
            <?
                    break;
			case "EMAIL":
			?>
                <div class="form__item">
                    <input id="name" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" type="email" class="input" placeholder="<?=Loc::getMessage("REGISTER_FIELD_" . $FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>" <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>required<?endif?>>
                </div>
			<?
			break;
                default:
                    ?>

                <div class="form__item">
                    <input id="name" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" type="text" class="input" placeholder="<?=Loc::getMessage("REGISTER_FIELD_" . $FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>" <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>required<?endif?>>
                </div>
            <?

            }?></td>
        <?endforeach?>

        <?
        if ($arResult["USE_CAPTCHA"] == "Y")
        {
            ?>
            <div class="form__item">
                <input name="captcha_word" type="text" class="input input__captcha" maxlength="50" value="" autocomplete="off" placeholder="<?=Loc::getMessage("REGISTER_CAPTCHA_PROMT")?>" required>

                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
            </div>

            <?
        }
        ?>

    <div class="form__radio-group form__radio-group_nom" data-role="container-personal">
        <div class="form__radio-desc" data-role="text-personal">*Обязательные поля для заполнения</div>
    </div>

    <input type="submit" name="register_submit_button" class="button button--basic form__submit" id="btn_form_id1" value="Зарегистрироваться" />

    <div class="form__radio-group form__radio-group_nom">
        <span class="form__radio-desc">Уже есть аккаунт? <a href="/auth" class="link_green"> Войдите под своими данными</a></span>
    </div>

</form>
<?endif?>