<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<ul class="ul nav__list">
		<? foreach ($arResult as $arItem): ?>

			<li class="li nav__item">
				<a href="<?= $arItem["LINK"] ?>" class="a nav__link"><?= $arItem["TEXT"] ?></a>
			</li>

		<? endforeach ?>
	</ul>
<? endif ?>