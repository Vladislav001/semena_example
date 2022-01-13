<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="feedback">
    <h2 class="h2 feedback__title">
        Обратная связь
    </h2>

	<? if (!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach ($arResult["ERROR_MESSAGE"] as $v)
        {
			ShowError($v);
        }
	}
	if (strlen($arResult["OK_MESSAGE"]) > 0)
	{
		?><?= $arResult["OK_MESSAGE"] ?><?
	}
	?>

	<? if (strlen($arResult["OK_MESSAGE"]) == 0): ?>
        <form action="<?= POST_FORM_ACTION_URI ?>" class="feedback__form" method="POST">
			<?= bitrix_sessid_post() ?>

            <label class="field">
                <span class="IH"><?= Loc::getMessage("MFT_NAME") ?></span>
                <input class="input field__input" type="text" name="name"
                       placeholder="<?= Loc::getMessage("MFT_NAME") ?>" value="<?= $arResult["name"] ?>">
            </label>
            <div class="field-row feedback__row">
                <label class="field">
                    <span class="IH"><?= Loc::getMessage("MFT_PHONE") ?></span>
                    <input class="input field__input" type="text" name="phone"
                           placeholder="<?= Loc::getMessage("MFT_PHONE") ?>" value="<?= $arResult["phone"] ?>">
                </label>
                <label class="field">
                    <span class="IH"><?= Loc::getMessage("MFT_EMAIL") ?></span>
                    <input class="input field__input" type="email" name="email"
                           placeholder="<?= Loc::getMessage("MFT_EMAIL") ?>" value="<?= $arResult["email"] ?>">
                </label>
            </div>
            <label class="field">
                <span class="IH"><?= Loc::getMessage("MFT_MESSAGE") ?></span>
                <textarea class="input field__input input--text" name="message"
                          placeholder="<?= Loc::getMessage("MFT_MESSAGE") ?>"><?= $arResult["message"] ?></textarea>
            </label>

			<?if($arParams["USE_CAPTCHA"] == "Y"):?>
                <div class="field-row feedback__row">
                    <label class="field">
                        <input class="input field__input" type="text" name="captcha_word" value=""
                               placeholder="<?= GetMessage("MFT_CAPTCHA_CODE") ?>">
                    </label>
                    <label class="field field__captcha">
                        <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180"
                             height="40" alt="CAPTCHA" class="field__captcha_img">
                    </label>
                </div>
			<?endif;?>

            <div class="feedback__bottom">
                <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
                <input type="submit" name="submit" class="feedback__submit button button--dark"
                       value="<?= Loc::getMessage("MFT_SUBMIT") ?>">
            </div>
        </form>
	<? endif; ?>
</div>