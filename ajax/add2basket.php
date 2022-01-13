<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("sale");
Loader::includeModule("catalog");

$id = intval($_POST['id']);
$count = intval($_POST['count']);

if ($id > 0 && $count > 0)
{
	$result = Add2BasketByProductID($id, $count);

	if ($result)
	{
		$data = array(
			'status' => 'success',
			'message' => 'Товар добавлен в корзину'
		);

		// получить инфу о товаре
		$resElement = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => IBLOCK_CATALOG, "ID" => $id), false, false, array(
			"IBLOCK_ID",
			"ID",
            "NAME",
            "PREVIEW_PICTURE",
			"PREVIEW_TEXT"
		));

		if ($arElement = $resElement->GetNext())
		{
			$arElement['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arElement['PREVIEW_PICTURE'],
				array('width' => IMAGE_PARAMETERS['element-added2basket']['width'], 'height' => IMAGE_PARAMETERS['element-added2basket']['height']),
				IMAGE_PARAMETERS['element-added2basket']['resize_type']);
			$data['ELEMENT'] = $arElement;
		}
	} else
	{
		$message = 'Произошла ошибка при добавление товара. Повторите пожалуйста попытку.';

		if ($ex = $APPLICATION->GetException())
        {
			$message = $ex->GetString();
        }

		$data = array(
			'status' => 'error',
			'message' => $message
		);
	}
} else
{
	$data = array(
		'status' => 'error',
		'message' => 'Произошла ошибка при добавление товара. Повторите пожалуйста попытку.'
	);
}
?>

<div class="form">
	<div class="h2"><?= $data['message'] ?></div>

	<? if ($data['status'] == 'success'): ?>
		<div class="card-form">
            <?if ($data['ELEMENT']['PREVIEW_PICTURE']):?>
                <div class="card-form__img">
                    <img src="<?=$data['ELEMENT']['PREVIEW_PICTURE']['src']?>" alt=""
                         class="card-form__picture">
                </div>
            <?endif;?>

			<div class="card-form__text">
				<div class="a item__name"><?=$data['ELEMENT']['NAME']?></div>
				<div class="form__desc"><?=$data['ELEMENT']['PREVIEW_TEXT']?></div>
				<div class="form__desc">Кол-во: <span class="item__name"><?=$count?> шт.</span></div>
				<a href="/personal/cart" class="button button--basic">Перейти в корзину</a>
                <a href="javascript:Fancybox.close();" class="button button--basic">Продолжить</a>
			</div>
		</div>
	<? endif; ?>
</div>
<a href="javascript:Fancybox.close();" class="carousel__button is-close" title="Close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M20 20L4 4m16 0L4 20"></path></svg></a>