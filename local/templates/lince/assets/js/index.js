$(document).ready(function ()
{
    /**
     * Функционал смены картинки мобильной и компьютерной версии для главного слайдера.
     * Событие на изменение разрешения экрана
     */
    $(window).resize(function ()
    {
        if (imgSliders.length)
        {
            let isMobile = false;
            if (window.innerWidth <= 960)
            {
                isMobile = true;
            }

            changeSrcImgSlider(imgSliders, isMobile)
        }
    });
});
/**
 * @var array imgSliders массив дум элементов картинок
 */
var imgSliders;
/**
 * Функционал смены картинки мобильной и компьютерной версии для главного слайдера.
 * Событие после загрузки дум дерева (не всего документа и скриптов)
 */
document.addEventListener("DOMContentLoaded", function ()
{
    imgSliders = document.querySelectorAll('[data-role="img-slider"]');
    if (imgSliders.length > 0 && window.innerWidth <= 960)
    {
        changeSrcImgSlider(imgSliders, true)
    }
});

/**
 * Функция изменяющая картинки на глвном слайдере
 */
function changeSrcImgSlider(imgSliders, isMobile)
{
    imgSliders.forEach((el) =>
    {
        const desktop = el.getAttribute('data-desktop')
        const mobile = el.getAttribute('data-mobile')

        if (isMobile && mobile != "0")
        {
            if (!el.classList.contains('mobile'))
            {
                el.setAttribute('src', mobile)
                el.classList.add('mobile')
                el.classList.remove('desktop')
            }
        } else
        {
            if (!el.classList.contains('desktop'))
            {
                el.setAttribute('src', desktop)
                el.classList.add('desktop')
                el.classList.remove('mobile')
            }
        }
    })

    let swiperContainer = document.querySelector('.main__slider')
    if (swiperContainer != null)
    {
        setTimeout(() =>
        {
            swiperContainer.swiper.update()
        }, 500)
    }
}
