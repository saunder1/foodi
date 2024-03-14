jQuery(document).ready(function($){

    var slider_auto, slider_loop, rtl;

    if (yummy_bites_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (yummy_bites_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (yummy_bites_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }

    //slider two
    if ($('.banner-slider.style-two .item-wrapper .item').length > 3) {
        sliderLoop3 = true;
    } else {
        sliderLoop3 = false;
    }

    $('.banner-slider.style-two .item-wrapper').owlCarousel({
        items: 3,
        autoplay: slider_auto,
        loop: sliderLoop3,
        nav: true,
        dots: false,
        rewind: false,
        margin: 30,
        autoplaySpeed: 800,
        rtl: rtl,
        autoplayTimeout: yummy_bites_data.speed,
        animateOut: yummy_bites_data.animation,
        responsive: {

            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1025: {
                items: 3,
            }
        }
    });
});
