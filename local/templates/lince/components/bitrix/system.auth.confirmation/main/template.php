<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

    <p><?=$arResult["MESSAGE_TEXT"] ?></p>
<? //here you can place your own messages
switch ($arResult["MESSAGE_CODE"])
{
	case "E01":
		?><? //When user not found
		break;
	case "E02":
		?><? //User was successfully authorized after confirmation
		break;
	case "E03":
		?><? //User already confirm his registration
		break;
	case "E04":
		?><? //Missed confirmation code
		break;
	case "E05":
		?><? //Confirmation code provided does not match stored one
		break;
	case "E06":
		?><? //Confirmation was successfull
		break;
	case "E07":
		?><? //Some error occured during confirmation
		break;
}
?>

<?if($arResult["MESSAGE_CODE"] == 'E03' || $arResult["MESSAGE_CODE"] == 'E06'):?>
    <a href="/auth/" class="link_green"><?= Loc::getMessage("CT_BSAC_AUTH") ?></a>
<?else:?>
    <form method="post" class="form" action="<?= $arResult["FORM_ACTION"] ?>">
        <div class="form__item">
            <input type="text"
                   name="<?= $arParams["LOGIN"] ?>"
                   maxlength="50"
                   value="<?= $arResult["LOGIN"] ?>"
                   placeholder="<?= Loc::getMessage("CT_BSAC_LOGIN") ?>"
                   size="17"
                   class="input">
        </div>

        <div class="form__item">
            <input type="text"
                   name="<?= $arParams["CONFIRM_CODE"] ?>"
                   maxlength="50"
                   value="<?= $arResult["CONFIRM_CODE"] ?>"
                   placeholder="<?= Loc::getMessage("CT_BSAC_CONFIRM_CODE") ?>"
                   size="17"
                   class="input">
        </div>

        <input type="submit" name="Login" class="button button--basic form__submit"
               value="<?= Loc::getMessage("CT_BSAC_CONFIRM") ?>"/>

        <input type="hidden" name="<? echo $arParams["USER_ID"] ?>" value="<? echo $arResult["USER_ID"] ?>"/>
    </form>
<?endif;?>