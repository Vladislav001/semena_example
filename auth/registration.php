<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
$APPLICATION->AddChainItem("Регистрация", "");

if ($USER->IsAuthorized())
{
	LocalRedirect('/');
}
?>

<? $APPLICATION->IncludeComponent("bitrix:main.register", "main", array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(
			"EMAIL",
			"PERSONAL_PHONE"
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			"EMAIL",
			"NAME",
			"LAST_NAME",
			"PERSONAL_PHONE"
		),
		"SUCCESS_PAGE" => $APPLICATION->GetCurPageParam('success=true', array('backurl')),
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>