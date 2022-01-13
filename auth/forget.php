<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
$APPLICATION->AddChainItem("Восстановление пароля", "");

if ($USER->IsAuthorized())
{
	LocalRedirect('/personal/');
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.auth.forgotpasswd",
    "main",
    Array(
        "AUTH_AUTH_URL" => "/auth/",
        "AUTH_REGISTER_URL" => "/auth/registration.php"
    )
);?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>