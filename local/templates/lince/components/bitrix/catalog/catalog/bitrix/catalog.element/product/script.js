$(function() {
    let $this = $('.detail__block');

    dataLayer.push({
        "ecommerce": {
            "currencyCode": "RUB",
            "detail": {
                "products": [
                    {
                        "id": $this.parent().find('.js_id').val(),
                        "name":  $this.parent().find('.js_name').val().trim(),
                        "price": parseInt($this.parent().find('.js_price').val()),
                    }
                ]
            }
        }
    });
});

$(document).on("click", ".item-tabs__link", function (e) {
    e.preventDefault();

    let id = $(this).attr('data-tab');
    let currentTab = $(this).next();

    if (!currentTab.hasClass('active'))
    {
       $('.item-tabs__link').not(this).removeClass('active');
       $(this).addClass('active');
    }

    let divTab =  $(`#${id}`);
    if (!divTab.hasClass('active'))
    {
        $('.item-tabs__pane').not(this).removeClass('active');
        divTab.addClass('active');
    }



});