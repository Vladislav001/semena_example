<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");
?><section class="listing">
<div class="page">
 <section class="content col">
	<div class="listing">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:search.page",
	"main",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "N",
		"DEFAULT_SORT" => "rank",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "products",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGE_RESULT_COUNT" => "10",
		"RESTART" => "Y",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "N",
		"USE_LANGUAGE_GUESS" => "N",
		"USE_SUGGEST" => "N",
		"USE_TITLE_RANK" => "Y",
		"arrFILTER" => array("iblock_1c_catalog"),
		"arrFILTER_iblock_1c_catalog" => array("all"),
		"arrFILTER_iblock_catalog" => array(0=>"all",),
		"arrWHERE" => ""
	)
);?>
	</div>
 </section>
</div>
 </section> <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>