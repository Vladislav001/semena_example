<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=");
?>
    <div>
        <h2>Контакты</h2>
        <span class="font-medium">Режим работы:</span> с Пн. по Пт. с 09:00 до 18:00<br>
    </div>
    <p>
        <span class="font-medium">Телефон:</span> <a href="tel:+74993915301">+7 (499) 123456</a>
    </p>
    <p> <span class="font-medium">Электронная почта интернет магазина:</span><a href="mailto:test@mail.ru"> test@mail.ru</a></p>

    <address class="address-contacts"><span class="font-medium">Адрес:</span> М123</address>

    <div id="map" style="height: 450px; width: 100%">
    </div>
    <script>
        ymaps.ready(init);

        function init()
        {
            let myMap = new ymaps.Map("map", {
                center: [],
                zoom: 18,
            });

            let marker = new ymaps.Placemark(
                [],
                {
                    balloonContent: "текст"
                },
                {
                    preset: 'islands#redDotIcon'
                }
            );

            myMap.geoObjects.add(marker);
        }

    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>