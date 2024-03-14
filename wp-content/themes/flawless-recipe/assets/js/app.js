(function($) {

  $('.recipe-slider-wrap').slick({
    infinite: true,
    autoplay: true,
    arrows: true,
    dots: false,
    slidesToShow: 4,
    pauseOnHover: false,
    centerMode: false,
    responsive: [
      {
        breakpoint: 990,
        settings: {
          slidesToShow: 2,
          autoplay: true,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          autoplay: true,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          autoplay: true,
          slidesToScroll: 1,
        }
      }
    ]
  });
  $('.big-slider-wrap').slick({
    infinite: true,
    autoplay: true,
    arrows: true,
    dots: false,
    slidesToShow: 1,
    pauseOnHover: false,
    centerMode: false,
  });
  
  $(window).load(function(){
    $('.page-loading').fadeOut();
 });


 $(".open-menu").click(function() {
  $(".navbar-collapse").addClass("in");
});

    $(".close-menu").click(function() {
  $(".navbar-collapse").removeClass("in");
});

$(".open-menu").keypress(function(e) {
var key = e.which;
if (key == 13) // the enter key code
{
  $(".navbar-collapse").addClass("in");
 }
});

    $(".close-menu").keypress(function(e) {
var key = e.which;
if (key == 13) // the enter key code
{
  $(".navbar-collapse").removeClass("in");
}
});


    function responsiveIframe() {
        var videoSelectors = [
            'iframe[src*="player.vimeo.com"]',
            'iframe[src*="youtube.com"]',
            'iframe[src*="youtube-nocookie.com"]',
            'iframe[src*="kickstarter.com"][src*="video.html"]',
            'iframe[src*="screenr.com"]',
            'iframe[src*="blip.tv"]',
            'iframe[src*="dailymotion.com"]',
            'iframe[src*="viddler.com"]',
            'iframe[src*="qik.com"]',
            'iframe[src*="revision3.com"]',
            'iframe[src*="hulu.com"]',
            'iframe[src*="funnyordie.com"]',
            'iframe[src*="flickr.com"]',
            'embed[src*="v.wordpress.com"]',
            'iframe[src*="videopress.com"]',
            'embed[src*="videopress.com"]'
            // add more selectors here
        ];
        var allVideos = videoSelectors.join(',');
        jQuery(allVideos).wrap('<span class="media-holder" />');
    }

    // Responsive Iframes
    responsiveIframe();



})(jQuery);

if (jQuery(window).width() < 991){
  const  flawless_recipe_focusableElements =
  'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
const flawless_recipe_modal = document.querySelector('#navbar-collapse'); 

const flawless_recipe_firstFocusableElement = flawless_recipe_modal.querySelectorAll(flawless_recipe_focusableElements)[0]; 
const flawless_recipe_focusableContent = flawless_recipe_modal.querySelectorAll(flawless_recipe_focusableElements);
const flawless_recipe_lastFocusableElement = flawless_recipe_focusableContent[flawless_recipe_focusableContent.length - 1];


document.addEventListener('keydown', function(e) {
let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

if (!isTabPressed) {
  return;
}

if (e.shiftKey) { // if shift key pressed for shift + tab combination
  if (document.activeElement === flawless_recipe_firstFocusableElement) {
    flawless_recipe_lastFocusableElement.focus(); // add focus for the last focusable element
    e.preventDefault();
  }
} else { // if tab key is pressed
  if (document.activeElement === flawless_recipe_lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
    flawless_recipe_firstFocusableElement.focus(); // add focus for the first focusable element
    e.preventDefault();
  }
}
});

flawless_recipe_firstFocusableElement.focus();
  }