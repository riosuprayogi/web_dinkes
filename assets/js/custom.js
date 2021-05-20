jQuery(document).ready(function($) {

  $('.banner_slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.thumbnail_slider',
    // dots: true,
    infinite: true,
    speed: 500,
  // fade: true,
  cssEase: 'linear'
});
  $('.thumbnail_slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    asNavFor: '.banner_slider',
    autoPlay:1500,
    pauseAutoPlayOnHover: false,
    dots: false,
    arrows: false,
    centerMode: true,
    focusOnSelect: true,
    autoplay: true,
    autoplaySpeed: 1500,
    // lazyLoad: 'ondemand'
  });


})