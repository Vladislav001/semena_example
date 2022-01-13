<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<div class="footer-menu">
		<? foreach ($arResult as $arItem): ?>

            <a href="<?= $arItem["LINK"] ?>" class="footer-menu__link"><?= $arItem["TEXT"] ?></a>

		<? endforeach ?>
	</div>
<? endif ?>