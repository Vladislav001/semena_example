<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>


<form class="person" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
	<?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>" />
    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

    <h2 class="person__title">Профиль</h2>
    <h3>Данные пользователя</h3>
    <div class="person__table">
        <div class="person__tr">
            <div class="person__td _gray"><?=GetMessage('NAME')?></div>
            <div class="person__td"><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
        </div>

        <div class="person__tr">
            <div class="person__td _gray"><?=GetMessage('LAST_NAME')?></div>
            <div class="person__td"><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>
        </div>

        <div class="person__tr">
            <div class="person__td _gray"><?=GetMessage('SECOND_NAME')?></div>
            <div class="person__td"><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>
        </div>

        <div class="person__tr">
            <div class="person__td _gray"><?=GetMessage('EMAIL')?></div>
            <div class="person__td"><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></div>
        </div>

        <div class="person__tr">
            <div class="person__td _gray"><?=GetMessage('USER_PHONE')?></div>
            <div class="person__td"><input type="text" name="PERSONAL_PHONE" maxlength="50" value="<? echo $arResult["arUser"]["PERSONAL_PHONE"]?>" /></div>
        </div>

        <div class="person__btn-group">
            <input class="button button--basic" type="submit" name="save" value="Сохранить">
        </div>
    </div>
</form>


<?if($arResult['ORDERS']['OTHER']):?>
<table class="table-person">
    <thead>
    <tr class="table-person_dark">
        <th colspan="5" class="table-person__title">Ваши текущие заказы</th>
    </tr>
    <tr class="table-person_light">
        <th>Номер заказа</th>
        <th>Дата заказа</th>
        <th>Статус заказа</th>
        <th>Оплата</th>
        <th>Сумма заказа</th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($arResult['ORDERS']['OTHER'] as $order):?>
        <tr>
            <td data-label="Номер заказа"><a href="/personal/order/?ID=<?=$order['ID']?>"><?=$order['ID']?></a></td>
            <td data-label="Дата заказа"><?=$order['DATE_INSERT']?></td>
            <td data-label="Статус заказа">
                <?=$order['PAYED'] == 'Y' ? 'Оплачено' : $order['STATUS_TEXT']?>
            </td>
            <td data-label="Оплата"><?=$order['PAY_SYSTEM_TEXT']?></td>
            <td data-label="Сумма заказа"><?=$order['PRICE']?>₽</td>
        </tr>
    <?endforeach;?>
    </tbody>
</table>
<?endif;?>

<?if($arResult['ORDERS']['COMPLETED']):?>
<table class="table-person">
    <thead>
    <tr class="table-person_dark">
        <th colspan="5" class="table-person__title">Ваши прошлые заказы</th>
    </tr>
    <tr class="table-person_light">
        <th>Номер заказа</th>
        <th>Дата заказа</th>
        <th>Статус заказа</th>
        <th>Оплата</th>
        <th>Сумма заказа</th>
    </tr>
    </thead>
    <tbody>
	<?foreach ($arResult['ORDERS']['COMPLETED'] as $order):?>
        <tr>
            <td data-label="Номер заказа"><a href="/personal/order/?ID=<?=$order['ID']?>"><?=$order['ID']?></a></td>
            <td data-label="Дата заказа"><?=$order['DATE_INSERT']?></td>
            <td data-label="Статус заказа">
				<?=$order['PAYED'] == 'Y' ? 'Оплачен' : $order['STATUS_TEXT']?>
            </td>
            <td data-label="Оплата"><?=$order['PAY_SYSTEM_TEXT']?></td>
            <td data-label="Сумма заказа"><?=$order['PRICE']?>₽</td>
        </tr>
	<?endforeach;?>
    </tbody>
</table>
<?endif;?>