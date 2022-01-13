<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Профиль");
$APPLICATION->SetTitle("Профиль");
$APPLICATION->AddChainItem("Профиль", "");

if (!$USER->IsAuthorized())
{
	LocalRedirect('/auth/');
}
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"profile",
	Array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>