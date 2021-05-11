jQuery(document).ready(function($) {

  $('.banner_slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    // prevNextButtons: true,
    asNavFor: '.thumbnail_slider',
    autoPlay:1500,
    prevNextButtons: true,
    pauseAutoPlayOnHover: false,
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
    prevNextButtons: true,
    pauseAutoPlayOnHover: false,
    dots: false,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    autoplay: true,
    autoplaySpeed: 1500,
    // lazyLoad: 'ondemand'
  });



  // 1st carousel, main
  $('.carousel-main2').flickity();
// 2nd carousel, navigation
$('.carousel-nav2').flickity({
  asNavFor: '.carousel-main2',
  contain: true,
  pageDots: false
});


})