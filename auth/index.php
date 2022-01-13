<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
$APPLICATION->AddChainItem("Авторизация", "");

if ($USER->IsAuthorized())
{
	LocalRedirect('/personal/');
}

?>

<? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "main", array(
        "FORGOT_PASSWORD_URL" => "/auth/forget.php",
        "PROFILE_URL" => "/personal/",
        "REGISTER_URL" => "/auth/registration.php",
        "SHOW_ERRORS" => "Y"
    )); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>