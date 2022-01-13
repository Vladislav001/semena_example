window.addEventListener('DOMContentLoaded', (event) => {

    // Menu button
    const menuBtn = document.querySelector('.menu-btn');
    const menu = document.querySelector('.header-mobile');
    if (menuBtn && menu) {
        let menuOpen = false;
        menuBtn.addEventListener('click', () => {
            if (!menuOpen) {
                menuBtn.classList.add('open');
                document.body.classList.add('fixed');
                menu.classList.add('open');
                menuOpen = true;
            } else {
                menuBtn.classList.remove('open');
                document.body.classList.remove('fixed');
                menu.classList.remove('open');
                menuOpen = false;
            }
        });
    }


    // Sliders items
    let sliders = document.querySelectorAll('.slider-wrapper');
    if (sliders) {
        sliders.forEach(slider => {
            let sliderWrapper = slider.querySelector('.slider');
            let right = slider.querySelector('.slider__button--next');
            let left = slider.querySelector('.slider__button--prev');
            const swiper = new Swiper(sliderWrapper, {
                slidesPerView: 4,
                spaceBetween: 20,
                navigation: {
                    nextEl: right,
                    prevEl: left,
                },
                breakpoints: {
                    0: {slidesPerView: 1},
                    320: {slidesPerView: 1},
                    640: {slidesPerView: 2},
                    920: {slidesPerView: 3},
                    1024: {slidesPerView: 4,  watchOverflow: true}
                }
            });

            slider = $(slider);

            if(slider.find('.swiper-slide').length === 1) {
                slider.find('.slider__button--next').css('display', 'none');
                slider.find('.slider__button--prev').css('display', 'none');
            }
        });
    }

    // Slider in main
    let mainSlider = document.querySelector('.main__slider');
    if (mainSlider) {
        const mainPageSwiper = new Swiper(mainSlider, {
            slidesPerView: 1,
            autoHeight: true,
            autoplay: {
                delay: 4000,
            },
            loop: true
        });
    }

    // Slider in detail
    let swiperDetailBig = document.querySelector('.item-gallery__slider');
    let swiperDetailThumbs = document.querySelector('.item-gallery__thumbs');
    if (swiperDetailBig && swiperDetailThumbs) {
        let swiperDetail = new Swiper(swiperDetailBig, {
            spaceBetween: 10,
            slidesPerView: 3,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            direction: 'horizontal',
        });
    
        let swiperDetail2 = new Swiper(swiperDetailThumbs, {
            spaceBetween: 10,
            thumbs: {
                swiper: swiperDetail,
            },
        });
    }

    // Accordion
    let accButtons = document.querySelectorAll('.accordion__btn');
    if (accButtons) {
        accButtons.forEach(accButton => {
            accButton.addEventListener('click', () => {
                let parent = accButton.parentNode;
                if (parent.classList.contains('close')) {
                    parent.classList.remove('close');
                } else {
                    parent.classList.add('close');
                }
            });
        });
    }

    // fancybox

    Fancybox.bind("[data-fancybox]", {
        on: {
            done: (fancybox, slide) => {
                if(typeof $ !== 'undefined' && $ !== null){
                    $('[type="tel"]').mask("+7 (999) 999-99-99");
                }
            },
        },
    });

    /**
     * Событие клика по чекбоксу согласия на персональные данные
     */
    $(document).on('click', '[data-role="text-personal"], [data-role="check-personal"]', function (){
        let $form = $(this).closest('form');
        $form.find('[data-role="container-personal"] .form__radio-label').toggleClass('form__radio-label_check');
    });

    /**
     * Раскрытие фильтра каталога в мобильной версии
     */

    $(document).on('click', '.aside-btn', function (){
        $('.aside_mobile').toggleClass('_active');
    });

    $(document).on('click', '.search-mobile .search__submit', function (e){



        if($('.search-mobile .search__input').val() !== ''){
            e.stopPropagation();
        } else {
            e.preventDefault();
            $('.search-mobile .search__form').toggleClass('_active');
        }
    });
});