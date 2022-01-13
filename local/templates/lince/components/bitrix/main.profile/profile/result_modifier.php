<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

Loader::includeModule('sale');

$arResult['ORDERS'] = array();

// получить статусы заказов
$saleStatusesDB = CSaleStatus::GetList();
$saleStatuses = array();
while ($saleStatus = $saleStatusesDB->Fetch())
{
	$saleStatuses[$saleStatus['ID']] = $saleStatus['NAME'];
}

// получить платежные системы
$paySystems = array();
$paySystemResult = \Bitrix\Sale\PaySystem\Manager::getList(array(
));

while ($paySystem = $paySystemResult->fetch())
{
	$paySystems[$paySystem['ID']] = $paySystem['NAME'];
}

// получить заказы текущего пользователя
$ordersDB = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"),  array(
	"USER_ID" => $USER->GetID(),
));

while ($arOrder = $ordersDB->Fetch())
{
	$arOrder['DATE_INSERT'] = date('d.m.Y', strtotime($arOrder['DATE_INSERT']));
	$arOrder['PRICE'] = getPrice($arOrder['PRICE']);
	$arOrder['PAY_SYSTEM_TEXT'] = $paySystems[$arOrder['PAY_SYSTEM_ID']];
	$arOrder['STATUS_TEXT'] = $saleStatuses[$arOrder['STATUS_ID']];

//	if (!$arOrder['DATE_PAYED'] && $paySystems[$arOrder['PAY_SYSTEM_ID']]['CODE'] == 'INTERNET_ACQUIRING_ALFA_BANK')
//	{
//		// todo логика для ссылки
//	}

	if ($arOrder['STATUS_ID'] == 'F')
	{
		$arResult['ORDERS']['COMPLETED'][] = $arOrder;
	} else
	{
		$arResult['ORDERS']['OTHER'][] = $arOrder;
	}
}
