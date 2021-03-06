<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\StringHelper;

?>
<div class="intec-basket-empty">
    <div class="intec-basket-empty-picture intec-basket-picture">
        <svg width="128" height="128" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0)">
                <path d="M127.211 26.6696C126.439 25.61 125.205 24.9829 123.893 24.9829H31.4871C31.308 24.9829 31.1293 24.9938 30.9571 25.017L27.1542 14.0544C26.76 12.9206 25.8921 12.0169 24.7766 11.5777L5.61054 4.04858C3.49823 3.22159 1.11464 4.25912 0.285072 6.36886C-0.543067 8.47974 0.494183 10.8648 2.60535 11.6943L20.0126 18.5326L41.3193 79.948C40.3789 80.2757 39.582 80.9973 39.2191 82.0068L33.0586 99.1193C32.681 100.169 32.8366 101.334 33.4791 102.246C34.1207 103.158 35.1643 103.701 36.2786 103.701H39.4422C37.4817 105.882 36.2786 108.756 36.2786 111.915C36.2786 118.709 41.8066 124.236 48.5996 124.236C55.3925 124.236 60.9205 118.709 60.9205 111.915C60.9205 108.756 59.7174 105.882 57.7569 103.701H84.6195C82.6581 105.882 81.4547 108.756 81.4547 111.915C81.4547 118.709 86.9816 124.236 93.776 124.236C100.57 124.236 106.097 118.709 106.097 111.915C106.097 108.756 104.894 105.882 102.934 103.701H106.782C108.672 103.701 110.204 102.169 110.204 100.278C110.204 98.3879 108.672 96.856 106.782 96.856H41.1483L44.9636 86.2583C45.4563 86.4657 45.9885 86.5883 46.5457 86.5883H106.781C108.566 86.5883 110.147 85.4348 110.691 83.7355L127.803 30.3442C128.205 29.0941 127.984 27.7292 127.211 26.6696ZM48.5996 117.391C45.5795 117.391 43.1237 114.935 43.1237 111.915C43.1237 108.895 45.5795 106.439 48.5996 106.439C51.6196 106.439 54.0754 108.895 54.0754 111.915C54.0754 114.935 51.6196 117.391 48.5996 117.391ZM93.7757 117.391C90.7556 117.391 88.2995 114.935 88.2995 111.915C88.2995 108.895 90.7556 106.439 93.7757 106.439C96.7955 106.439 99.2515 108.895 99.2515 111.915C99.2515 114.935 96.7955 117.391 93.7757 117.391ZM115.304 42.4377H94.3463V33.197H118.265L115.304 42.4377ZM109.269 61.2612H94.3463V50.6515H112.67L109.269 61.2612ZM67.1939 61.2612V50.6515H86.1322V61.2612H67.1939ZM86.1322 69.4758V78.3743H67.1939V69.4758H86.1322ZM39.8501 50.6515H58.9807V61.2612H43.5313L39.8501 50.6515ZM67.1939 42.4377V33.197H86.1322V42.4377H67.1939ZM58.9804 33.197V42.4377H36.9996L33.7939 33.197H58.9804ZM46.3815 69.4758H58.9804V78.3743H49.4684L46.3815 69.4758ZM94.3463 78.3745V69.4761H106.638L103.786 78.3745H94.3463Z" fill="#F2F2F2"/>
            </g>
            <defs>
                <clipPath id="clip0">
                    <rect width="128" height="128" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </div>
    <div class="intec-basket-empty-title">
        <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_EMPTY_TITLE') ?>
    </div>
    <div class="intec-basket-empty-description">
        <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_EMPTY_DESCRIPTION') ?>
    </div>
    <?php if (!empty($arParams['EMPTY_BASKET_HINT_PATH'])) { ?>
        <div class="intec-basket-empty-button intec-basket-align-middle">
            <a class="intec-basket-scheme-background intec-basket-scheme-background-light-hover" href="<?= StringHelper::replaceMacros($arParams['EMPTY_BASKET_HINT_PATH'], [
                'SITE_DIR' => SITE_DIR
            ]) ?>">
                <?= Loc::getMessage('C_BASKET_DEFAULT_1_TEMPLATE_EMPTY_URL') ?>
            </a>
        </div>
    <?php } ?>
</div>