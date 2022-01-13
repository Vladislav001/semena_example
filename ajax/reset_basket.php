<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("sale");

if ($_POST['value'] == 'Y')
{
	CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}