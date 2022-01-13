<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="ul header-mobile__pages">
		<? foreach ($arResult as $arItem): ?>

            <li class="li">
                <a href="<?= $arItem["LINK"] ?>" class="a"><?= $arItem["TEXT"] ?></a>
            </li>

		<? endforeach ?>
	</ul>
<? endif ?>