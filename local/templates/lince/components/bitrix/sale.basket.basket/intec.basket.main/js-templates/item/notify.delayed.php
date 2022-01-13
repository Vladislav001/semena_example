<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>
{{#DELAYED}}
    <div class="intec-basket-notify">
        <button class="intec-basket-notify-body" data-entity="basket-item-remove-delayed">
            <span class="intec-basket-grid intec-basket-grid-stretch">
                <span class="intec-basket-grid-item-auto">
                    <span class="intec-basket-notify-icon intec-basket-picture intec-basket-align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 13" fill="none">
                            <path d="M7.06634 10.3667L6.99967 10.4333L6.92634 10.3667C3.75967 7.49333 1.66634 5.59333 1.66634 3.66667C1.66634 2.33333 2.66634 1.33333 3.99967 1.33333C5.02634 1.33333 6.02634 2 6.37967 2.90667H7.61967C7.97301 2 8.97301 1.33333 9.99967 1.33333C11.333 1.33333 12.333 2.33333 12.333 3.66667C12.333 5.59333 10.2397 7.49333 7.06634 10.3667ZM9.99967 0C8.83967 0 7.72634 0.54 6.99967 1.38667C6.27301 0.54 5.15967 0 3.99967 0C1.94634 0 0.333008 1.60667 0.333008 3.66667C0.333008 6.18 2.59967 8.24 6.03301 11.3533L6.99967 12.2333L7.96634 11.3533C11.3997 8.24 13.6663 6.18 13.6663 3.66667C13.6663 1.60667 12.053 0 9.99967 0Z" fill="#FFF"/>
                        </svg>
                    </span>
                </span>
                <span class="intec-basket-grid-item-auto intec-basket-grid-item-shrink">
                    <span class="intec-basket-notify-content">
                        <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_ITEM_DELAYED_MESSAGE') ?>
                    </span>
                </span>
            </span>
        </button>
    </div>
{{/DELAYED}}