<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
    <div class="search col" id="<?echo $CONTAINER_ID?>">
		<form class="search__form" action="<?echo $arResult["FORM_ACTION"]?>" id="<?echo $CONTAINER_ID?>">
			<input type="text" id="<?echo $INPUT_ID?>" class="input search__input" name="q" value="" autocomplete="off" placeholder="поиск товара" value="поиск товара">
			<button class="button search__submit" type="submit">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/search.svg" alt="">
			</button>
		</form>
	</div>
<?endif?>
<script>
    BX.ready(function(){
        new JCTitleSearch({
            'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
            'INPUT_ID': '<?echo $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    });
</script>
