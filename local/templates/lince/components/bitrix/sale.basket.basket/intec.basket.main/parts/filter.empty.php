<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>
<div class="intec-basket-filter-empty" id="basket-item-list-empty-result" style="display: none;">
    <div class="intec-basket-filter-empty-picture intec-basket-picture">
        <svg width="110" height="112" viewBox="0 0 110 112" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M107.422 102.014L80.7655 74.2905C87.6193 66.143 91.3745 55.8919 91.3745 45.22C91.3745 20.2861 71.0884 0 46.1545 0C21.2206 0 0.93457 20.2861 0.93457 45.22C0.93457 70.1538 21.2206 90.4399 46.1545 90.4399C55.5151 90.4399 64.4352 87.6166 72.0616 82.2571L98.9203 110.191C100.043 111.357 101.553 112 103.171 112C104.703 112 106.156 111.416 107.258 110.354C109.602 108.099 109.677 104.36 107.422 102.014ZM46.1545 11.7965C64.5846 11.7965 79.578 26.7899 79.578 45.22C79.578 63.65 64.5846 78.6434 46.1545 78.6434C27.7244 78.6434 12.7311 63.65 12.7311 45.22C12.7311 26.7899 27.7244 11.7965 46.1545 11.7965Z"/>
        </svg>
    </div>
    <div class="intec-basket-filter-empty-content">
        <div class="intec-basket-filter-empty-title">
            <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_FILTER_EMPTY_TITLE') ?>
        </div>
        <div class="intec-basket-filter-empty-description">
            <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_FILTER_EMPTY_DESCRIPTION') ?>
        </div>
    </div>
</div>
