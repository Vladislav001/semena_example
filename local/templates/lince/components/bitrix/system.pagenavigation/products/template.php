<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="pagination">

    <ul class="ul pagination__list">

		<? if ($arResult["bDescPageNumbering"] === true): ?>

			<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
				<? if ($arResult["bSavePage"]): ?>
                    <li class="pagination__item pagination__item--prev">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                           class="a pagination__link">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                        </a>
                    </li>

					<? if ($arResult['NavPageNomer'] > 3 && $arResult['NavPageCount'] > 5): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"
                               class="a pagination__link">1</a>
                        </li>
					<? endif; ?>

					<? if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= intval($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2) ?>"
                               class="a pagination__link">...</a>
                        </li>
					<? endif; ?>
				<? else: ?>
					<? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)): ?>
                        <li class="pagination__item pagination__item--prev">
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="a pagination__link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                            </a>
                        </li>
					<? else: ?>
                        <li class="pagination__item pagination__item--prev">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                               class="a pagination__link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                            </a>
                        </li>
					<? endif ?>
					<? if ($arResult['NavPageNomer'] > 3 && $arResult['NavPageCount'] > 5): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="a pagination__link">1</a>
                        </li>
					<? endif; ?>
				<? endif ?>
			<? endif ?>

			<? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
				<? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

				<? if ($arResult["nEndPage"] > 2): ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nEndPage"] / 2) ?>"
                           class="a pagination__link">...</a>
                    </li>
				<? endif; ?>

				<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="pagination__item pagination__item--active">
                        <span class="pagination__link"><?= $NavRecordGroupPrint ?></span>
                    </li>
				<? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                           class="a pagination__link"><?= $NavRecordGroupPrint ?></a>
                    </li>
				<? else: ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
                           class="a pagination__link"><?= $NavRecordGroupPrint ?></a>
                    </li>
				<? endif ?>

				<? $arResult["nStartPage"]-- ?>
			<? endwhile ?>

			<? if ($arResult["NavPageNomer"] > 1): ?>

				<? if ($arResult["NavPageCount"] != $arResult["NavPageNomer"] - 1 && ($arResult["NavPageCount"] - $arResult["NavPageNomer"] > 5)): ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
                           class="a pagination__link"><?= $arResult["NavPageCount"] ?></a>
                    </li>
				<? endif; ?>

                <li class="pagination__item pagination__item--next">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                       class="a pagination__link">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                    </a>
                </li>
			<? endif ?>

		<? else: ?>

			<? if ($arResult["NavPageNomer"] > 1): ?>

				<? if ($arResult["bSavePage"]): ?>
                    <li class="pagination__item pagination__item--prev">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                           class="a pagination__link">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                        </a>
                    </li>
					<? if ($arResult['NavPageNomer'] > 3 && $arResult['NavPageCount'] > 5): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
                               class="a pagination__link">1</a>
                        </li>
					<? endif; ?>
				<? else: ?>
					<? if ($arResult["NavPageNomer"] > 2): ?>
                        <li class="pagination__item pagination__item--prev">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                               class="a pagination__link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                            </a>
                        </li>
					<? else: ?>
                        <li class="pagination__item pagination__item--prev">
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="a pagination__link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                            </a>
                        </li>
					<? endif ?>

					<? if ($arResult['NavPageNomer'] > 3 && $arResult['NavPageCount'] > 5): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="a pagination__link">1</a>
                        </li>
					<? endif; ?>

					<? if ($arResult["nStartPage"] > 2): ?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nStartPage"] / 2) ?>"
                               class="a pagination__link">...</a>
                        </li>
					<? endif; ?>

				<? endif ?>
			<? endif ?>

			<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

				<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="pagination__item pagination__item--active">
                        <span class="pagination__link"><?= $arResult["nStartPage"] ?></span>
                    </li>
				<? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                           class="a pagination__link"><?= $arResult["nStartPage"] ?></a>
                    </li>
				<? else: ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
                           class="a pagination__link"><?= $arResult["nStartPage"] ?></a>
                    </li>
				<? endif ?>
				<? $arResult["nStartPage"]++ ?>
			<? endwhile ?>

			<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]) ;

			if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
				if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
					if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
						?>
                        <li class="pagination__item">
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2) ?>"
                               class="a pagination__link">...</a>
                        </li>
					<?
					endif;
					?>

				<?
				endif;
			endif;
			?>

			<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>

				<? if ($arResult["NavPageCount"] != $arResult["NavPageNomer"] + 1 && ($arResult["NavPageCount"] - $arResult["NavPageNomer"] > 2) && $arResult['NavPageCount'] > 5): ?>
                    <li class="pagination__item">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"
                           class="a pagination__link"><?= $arResult["NavPageCount"] ?></a>
                    </li>
				<? endif; ?>

                <li class="pagination__item pagination__item--next">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                       class="a pagination__link">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/pagination.svg" alt="">
                    </a>
                </li>
			<? endif ?>

		<? endif ?>

    </ul>

</div>