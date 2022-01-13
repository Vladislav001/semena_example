window.dataLayer = window.dataLayer || [];

/**
 * Добавление в корзину
 */
$(document).on('click', '.js-to-basket', function (e)
{
    if ($('#fancybox').length === 0)
    {
        $("body").append("<div id='fancybox' style='display: none'></div>");
    }

    let count = $(this).parent().find('[name = "QUANTITY"]').val();
    toBasket($(this), count)
});

$(document).on('click', '.js-decrement', function (e)
{
    let counter = $(this).next('.counter__field');
    let count = counter.val();

    if (count > 1)
    {
        count--;
        counter.val(count);

        let priceElem = counter.parent().prev('.price');
        let priceValue = counter.parent().parent().parent().find('.js_price').val();
        updatePriceProduct(priceElem, priceValue, count);
    }
});

$(document).on('click', '.js-increment', function (e)
{
    let counter = $(this).prev('.counter__field');
    let count = counter.val();
    count++;
    counter.val(count);

    let priceElem = counter.parent().prev('.price');
    let priceValue = counter.parent().parent().parent().find('.js_price').val();
    updatePriceProduct(priceElem, priceValue, count);
});

$(document).on('change', '.js-counter', function (e)
{
    let count = parseInt($(this).val(), 10);
    let priceElem = $(this).parent().parent().find('.price');

    if (isNaN(count) || count < 1)
    {
        $(this).val(1);
        priceElem.text(priceElem.attr("data-val") + '₽');
        alert("Неккоретное значение");
    } else
    {
        let priceValue = priceElem.parent().parent().find('.js_price').val();
        updatePriceProduct(priceElem, priceValue, count);
    }
});

/**
 * Очистить корзину
 */
$(document).on('click', '.js-reset-basket', function (e)
{
    let data = {
        value: 'Y'
    }

    request('/ajax/reset_basket.php', 'POST', data)
        .then(response => {
            location.reload();
        })
        .catch((error) => {
            alert("Произошла ошибка");
        });
});

/**
 * Сортировка в каталоге
 */
$(document).on('click', '.sort__select', function (e)
{
    let currentUrl = window.location.href.split("?")[0];
    let updUrl = currentUrl + $(this).val();

    $.ajax({
        type: "GET",
        url: updUrl,
        success: function(data) {

            history.pushState({}, null, updUrl);

            let $data = $(data);
            let updElements = $data.find('.listing__list');
            let updPagination = $data.find('.pagination');

            $('.listing__list').replaceWith(updElements);
            $('.pagination').replaceWith(updPagination)
        }
    });
});

/**
 * Смена вида в каталоге
 */
$(document).on('click', '.view__item', function (e)
{
    if (!$(this).hasClass('view__item--active'))
    {
        $(".view__item").removeClass("view__item--active");
        $(this).addClass("view__item--active");

        let type = $(this).find('input').val();

        if (type === 'list')
        {
            $(".listing__item").addClass("list");
        } else
        {
            $(".listing__item").removeClass("list");
        }
    }
});

/**
 * Открытие подразделов в каталоге
 */

let isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

if (isMobile) {
    $(document).on('click', '.catalog-section__item.arrow', function (e){
        e.preventDefault();
        $(this).next('.catalog-section__block').slideToggle();
        $(this).children('.catalog-section__arrow').toggleClass('_active');
    });
} else {
    $(document).on('click', '.catalog-section__item .catalog-section__arrow', function (e){
        $(this).parent('.catalog-section__item').next('.catalog-section__block').slideToggle();
        $(this).toggleClass('_active');
    });
}



/**
 * Открытие списка в деталке заказа
 */

$(document).ready(function (){
    let linkMoreOrderInformation = $('.sale-order-detail-about-order-inner-container-name-read-more');
    let linkShow = $('.sale-order-detail-show-link');
    let clientInformation = $('.sale-order-detail-about-order-inner-container-details');
    let clientMap = $('.sale-order-detail-payment-options-shipment-composition-map');

    function openLink(title, blockShow){
        $(title).on('click', function (){
            blockShow.toggleClass('active');
            $(this).toggleClass('active');
        });
    }

    openLink(linkMoreOrderInformation,clientInformation);
    openLink(linkShow,clientMap);

});


function request(address, httpMethod = "POST", data = {}) {

    if (httpMethod === "POST" && !(data instanceof FormData)) {
        let formData = new FormData();
        data = objToForm(data, formData)
    }

    let url = location.origin + address;

    if (httpMethod === "GET")
    {
        url = url + '?' + objToGetParams(data);
    }

    let init = {
        type: httpMethod,
        url: url,
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function () {
            //  showPreloader();
        },
        success: function () {
            // hidePreloader();
        },
        error: function () {
            // hidePreloader();
        }
    };

    return $.ajax(init);
}

function objToForm(data, formData) {
    for (let pos in data) {
        formData.append(pos, data[pos]);
    }
    return formData;
}

function objToGetParams(data) {
    return Object.keys(data).map(key => key + '=' + data[key]).join('&');
}

// function showPreloader() {
//
// }
//
// function hidePreloader() {
//
// }

/**
 * Функция добавление в корзину
 * @param $this
 * @param count
 */
function toBasket($this, count) {

    let data = {
        "id": $this.attr("data-id"),
        "count": count
    };

    $this.parent().find('.counter__field').val(1);
    let priceVal = $this.parent().parent().find('.js_price').val();
    let priceElem = $this.parent().parent().find('.price');
    priceElem.text(priceVal + '₽');

    dataLayer.push({
        "ecommerce": {
            "currencyCode": "RUB",
            "add": {
                "products": [
                    {
                        "id": data.id,
                        "name":  $this.parent().parent().find('.js_name').val().trim(),
                        "price": parseInt(priceVal),
                        "quantity": parseInt(data.count)
                    }
                ]
            }
        }
    });

    ym(85710449,'reachGoal','toBasket');

    request('/ajax/add2basket.php', 'POST', data)
        .then(response => {
            $('#fancybox').html(response)

            BX.onCustomEvent('OnBasketChange');

            Fancybox.show([
                {
                    src: '#fancybox',
                    type: 'inline',
                    closeButton: false
                },
            ]);
        })
        .catch((error) => {
            alert("Произошла ошибка");
        });
}

/**
 * Форма подписки
 */
$(document).on('click', '.js_subscribe', function (e)
{
    request('/ajax/fancybox/subscribe_form.php', 'GET')
        .then(html => {
            Fancybox.show([
                {
                    src: html,
                    type: 'html'
                },
            ]);
        })
        .catch((error) => {
            alert("Произошла ошибка");
        });
});

/**
 * Подписка
 */
$(document).on('submit', '.js_form_subscribe', function (e)
{
    e.preventDefault();

    let data = {
      email: $(this).find("[name='email']").val()
    };

    request('/ajax/subscribe.php', 'POST', data)
        .then(response => {
            response = JSON.parse(response);
            $(this).html(response.message);
        })
        .catch((error) => {
            alert("Произошла ошибка");
        });
});

/**
 * Изменение цены от кол-ва товаров
 *
 * @param priceElem
 * @param priceValue
 * @param count
 */
function updatePriceProduct(priceElem, priceValue, count)
{
    let val = priceValue;
    val = val.replace(/\s+/g, '');

    let updPrice = (val * count).toFixed(1);
    let splitPrice = updPrice.split(".");

    if (splitPrice[1] == 0)
    {
        updPrice = splitPrice[0];
        updPrice = parseFloat(updPrice);
        updPrice = updPrice.toLocaleString();
    }

    priceElem.text(updPrice + '₽');
}


$(document).on('keyup', '.js_input_geo', function (e)
{
    let name = $(this).val().toLowerCase();
    let cities = $('.geo-choose-scroll').find('div')

    for (let elem of cities) {
        // todo логика скрытия стран (если нет городов), пока не делаю, мб фронт другой будет

        if (name.length == 0 || elem.matches('[data-name^="' + name + '"]')) {
            elem.classList.remove("hidden");
        } else {
            elem.classList.add("hidden");
        }
    }
});

/**
 * Смена geo-инфы
 */
$(document).on('click', '.js_select_geo', function (e)
{
    e.preventDefault();
    let data = {
        city_id: $(this).attr('data-id')
    };

    request('/ajax/fancybox/choose_geo.php', 'POST', data)
        .then(response =>
        {
            response = JSON.parse(response);
            if (response['success'] === 1)
            {
                location.reload();
            }
        })
        .catch((error) =>
        {
            alert("Произошла ошибка");
        });
});