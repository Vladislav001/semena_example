<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<ul class="ul header-pages">
		<? foreach ($arResult as $arItem): ?>

            <li class="li header-pages__item">
                <a href="<?= $arItem["LINK"] ?>" class="a header-pages__link"><?= $arItem["TEXT"] ?></a>
            </li>

		<? endforeach ?>
	</ul>
<? endif ?>