<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$site = ($_REQUEST["site"] <> '' ? $_REQUEST["site"] : ($_REQUEST["src_site"] <> '' ? $_REQUEST["src_site"] : false));
$arFilter = Array(
	"TYPE_ID" => "FEEDBACK_FORM",
	"ACTIVE" => "Y"
);
if ($site !== false) $arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by = "ID", $order = "DESC", $arFilter);
while ($arType = $dbType->GetNext()) $arEvent[$arType["ID"]] = "[" . $arType["ID"] . "] " . $arType["SUBJECT"];

$arComponentParameters = array(
	"PARAMETERS" => array(
		"USE_CAPTCHA" => Array(
			"NAME" => Loc::getMessage("MFP_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => Loc::getMessage("MFP_OK_MESSAGE"),
			"TYPE" => "STRING",
			"DEFAULT" => Loc::getMessage("MFP_OK_TEXT"),
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => Loc::getMessage("MFP_EMAIL_TO"),
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")),
			"PARENT" => "BASE",
		),
		"REQUIRED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_REQUIRED_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => Array(
				"NONE" => Loc::getMessage("MFP_ALL_REQ"),
				"EMAIL" => "E-mail",
				"NAME" => Loc::getMessage("MFP_NAME"),
				"PHONE" => Loc::getMessage("MFP_PHONE"),
				"MESSAGE" => Loc::getMessage("MFP_MESSAGE"),
				"PROCESSING_PERSONAL_DATA" => Loc::getMessage("MFP_PROCESSING_PERSONAL_DATA")
			),
			"DEFAULT" => "",
			"COLS" => 25,
			"PARENT" => "BASE",
		),

		"EVENT_MESSAGE_ID" => Array(
			"NAME" => Loc::getMessage("MFP_EMAIL_TEMPLATES"),
			"TYPE" => "LIST",
			"VALUES" => $arEvent,
			"DEFAULT" => "",
			"MULTIPLE" => "Y",
			"COLS" => 25,
			"PARENT" => "BASE",
		),

	)
);