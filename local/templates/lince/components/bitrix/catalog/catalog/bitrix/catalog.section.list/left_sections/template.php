<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>

<? if ($arResult['SECTIONS']): ?>
    <aside class="aside col">
        <div class="catalog-section">
            <h3 class="aside-filter__title">
                Разделы
            </h3>
            <ul class="catalog-section__block">
				<? foreach ($arResult['SECTIONS'] as $arSection):?>
                    <li class="catalog-section__list">
                        <div class="catalog-section__item">
                            <a class="catalog-section__link" href="<?=$arSection['SECTION_PAGE_URL']?>filter/new-is-y/apply/"><?= $arSection['NAME'] ?></a>
                        </div>
                    </li>
				<? endforeach; ?>
            </ul>
        </div>
    </aside>
<? endif; ?>