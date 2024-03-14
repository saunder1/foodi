jQuery(document).ready(function($) {

    var slider_auto, slider_loop, rtl;

    if (spicy_recipe_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (spicy_recipe_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (spicy_recipe_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }

    //slider two & featured recipe two & three
    if ($('.banner-slider.style-two .item-wrapper .item').length > 4 ) {
        sliderLoop2 = true;
    }

    $('.banner-slider.style-two .item-wrapper').owlCarousel({
        items: 4,
        autoplay: slider_auto,
        loop: slider_loop,
        nav: true,
        dots: false,
        rewind: false,
        margin: 30,
        autoplaySpeed: 800,
        rtl: rtl,
        navText: [
            '<svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689"><g transform="translate(17.729 11.628) rotate(180)"><path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5"/><path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5"/></g></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689"><g transform="translate(0.75 1.061)"><path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5"/><path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5"/></g></svg>'
        ],
        responsive: {

            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1025: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });

    //header four secondary menu toggle
    if ($('.site-header').hasClass('style-four')) {

        //add tabindex for submenu toggle button
        $('.site-header:not(.style-four) .nav-menu li button').attr('tabindex', -1);

        $('.header-top .secondary-menu > div').prepend('<button class="close"></button>');

        $('.site-header.style-four .header-top .secondary-menu > div').css('width', 0);
        $('.header-top .secondary-menu .toggle-btn').on('click', function(e) {
            e.stopPropagation();
            $(this).parents('.secondary-menu').addClass('menu-active');
            $(this).siblings('div').animate({
                width: 320,
            });
        });

        $('.header-top .secondary-menu .close').on('click', function(e) {

            $(this).parent('div').animate({
                width: 0,
            });
            $(this).parents('.secondary-menu').removeClass('menu-active');
        });

        $('.site-header.style-four .secondary-menu > div').click(function(e) {
            e.stopPropagation();
        });

        $(window).click(function(e) {

            $('.site-header.style-four .secondary-menu > div').animate({
                width: 0,
            });
            $('.site-header.style-four .secondary-menu').removeClass('menu-active');
        });

        // $('.site-header.style-four .header-top .secondary-menu .nav-menu li .submenu-toggle').click(function() {
        //     $(this).toggleClass('active');
        //     $(this).siblings('.sub-menu').stop(true, false, true).slideToggle();
        // });
    }

    // secondary menu

    var focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    var modals = document.querySelector(".site-header.style-four .header-top .header-left .secondary-menu"); // select the modal by it's element
    if (modals == null) {
        return;

    }
    var closeBttn = document.querySelector('.site-header.style-four .header-top .secondary-menu .close'); // select the modal by it's id
    var firstFocusableElements = modals.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal

    var focusableContents = modals.querySelectorAll(focusableElements);
    var lastFocusableElements = focusableContents[focusableContents.length - 1]; // get last element to be focused inside modal


    document.addEventListener('keydown', function (e) {
        var isTabPressed = e.key === 'Tab' || e.which == 9;
        if (!isTabPressed) {
            return;
        }
        if (e.shiftKey) {
            // if shift key pressed for shift + tab combination
            if (document.activeElement === firstFocusableElements) {
                lastFocusableElements.focus(); // add focus for the last focusable element
                e.preventDefault();
            }
        } else {
            // if tab key is pressed
            if (document.activeElement === lastFocusableElements) {
                // if focused has reached to last focusable element then focus first focusable element after pressing tab
                //   firstFocusableElements.focus(); // add focus for the first focusable element
                closeBttn.focus(); // add focus for the first focusable element
                e.preventDefault();
            }
        }
    });
    firstFocusableElements.focus();

});