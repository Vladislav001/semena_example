<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
Loader::includeModule("sale");

global $APPLICATION;

$cp = $this->__component; // ������ ����������
 
if (is_object($cp)) {
    // �������� ������ � �������
    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        )
    );

    $totalAmount = $count = 0;
    while($arItem = $dbBasketItems->GetNext()) {
        $count += $arItem["QUANTITY"];
        // ���� ��� ����������� � ������ �� ���������
        $totalAmount += $arItem["PRICE"] * $arItem["QUANTITY"];
        $cp->arResult["ITEMS"][] = $arItem;
    }
    /* ����� ������������ �� ����������������� ������� CSaleLang */
    $defaultCurr = CSaleLang::GetLangCurrency(SITE_ID);
    // ���������
    $cp->arResult['TOTAL_AMOUNT'] = SaleFormatCurrency($totalAmount, $defaultCurr);
    //���-�� �������
    $cp->arResult['PRODUCT_COUNT'] = $count;
} ?>