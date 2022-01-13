<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loader::includeModule("iblock");
Loc::loadMessages(__FILE__);

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$arResult["PARAMS_HASH"] = md5(serialize($arParams) . $this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if ($arParams["EVENT_NAME"] == '') $arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if ($arParams["EMAIL_TO"] == '') $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if ($arParams["OK_TEXT"] == '') $arParams["OK_TEXT"] = Loc::getMessage("MF_OK_MESSAGE");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if (check_bitrix_sessid())
	{
		if (empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["name"]) <= 1) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_REQ_NAME");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["phone"]) <= 1) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_REQ_PHONE");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["email"]) <= 1) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_REQ_EMAIL");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["message"]) <= 3) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_REQ_MESSAGE");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("PROCESSING_PERSONAL_DATA", $arParams["REQUIRED_FIELDS"])) && empty($_POST["processing_personal_data"])) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_REQ_PROCESSING_PERSONAL_DATA");
		}
		if (strlen($_POST["email"]) > 1 && !check_email($_POST["email"])) $arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_EMAIL_NOT_VALID");
		if ($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
				{
					$arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_CAPTCHA_WRONG");
				}
			} else
			{
				$arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_CAPTHCA_EMPTY");
			}

		}

		if (empty($arResult["ERROR_MESSAGE"]))
		{
			$el = new CIBlockElement;
			$arData = array(
				"IBLOCK_ID" => IBLOCK_FEEDBACK,
				"NAME" => $_POST["name"],
				"PROPERTY_VALUES" => array(
					"PHONE" => $_POST["phone"],
					"EMAIL" => $_POST["email"],
					"MESSAGE" => array(
						"VALUE" => array(
							"TEXT" => $_POST["message"],
							"TYPE" => "text"
						)
					)
				),
			);

			if ($elementID = $el->Add($arData)) {
				$arFields = array(
					"EMAIL_TO" => $arParams["EMAIL_TO"],
					"NAME" => $_POST["name"],
					"PHONE" => $_POST["phone"],
					"EMAIL" => $_POST["email"],
					"MESSAGE" => $_POST["message"],
				);

				if (!empty($arParams["EVENT_MESSAGE_ID"]))
				{
					foreach ($arParams["EVENT_MESSAGE_ID"] as $v) if (IntVal($v) > 0)
					{
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
					}
				} else
				{
					CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
				}

				$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["name"]);
				$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["email"]);
				LocalRedirect($APPLICATION->GetCurPageParam("success=" . $arResult["PARAMS_HASH"], array("success")));
			} else {
				$arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_SOME_ERROR");
			}
		}

		$arResult["name"] = htmlspecialcharsbx($_POST["name"]);
		$arResult["email"] = htmlspecialcharsbx($_POST["email"]);
		$arResult["phone"] = htmlspecialcharsbx($_POST["phone"]);
		$arResult["message"] = htmlspecialcharsbx($_POST["message"]);
	} else
	{
		$arResult["ERROR_MESSAGE"][] = Loc::getMessage("MF_SESS_EXP");
	}
} elseif ($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if (empty($arResult["ERROR_MESSAGE"]))
{
	if ($USER->IsAuthorized())
	{
		if($USER->GetEmail())
		{
			$arResult["name"] = $USER->GetFormattedName(false); // т.к авторизовались реально, а не через созданный заказ
		}

		$arResult["email"] = htmlspecialcharsbx($USER->GetEmail());
	} else
	{
		if (strlen($_SESSION["MF_NAME"]) > 0)
		{
			$arResult["name"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		}
		if (strlen($_SESSION["MF_EMAIL"]) > 0)
		{
			$arResult["email"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
		}
	}
}

if ($arParams["USE_CAPTCHA"] == "Y")
{
	$arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
}

$this->IncludeComponentTemplate();
