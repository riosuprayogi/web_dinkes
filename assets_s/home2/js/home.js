$( document ).ready(function($){
    
  $("#owl-carousel-siaran").owlCarousel({
        loop: true,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplayHoverPause: true,
        nav : true,
	  	navText : ['<div class="rny-arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>','<div class="rny-arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>'],
        pagination:false,
	  	dots : false,
	  	responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:1,
				nav:true
			},
			1000:{
				items:1,
				nav:true
			}
		}
    });
	
	$("#owl-carousel-berita").owlCarousel({
        loop: true,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplayHoverPause: true,
        nav : true,
	  	navText : ['<div class="rny-arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>','<div class="rny-arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>'],
        pagination:false,
	  	dots : false,
	  	responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:1,
				nav:true
			},
			1000:{
				items:1,
				nav:true
			}
		}
    });
	
	$("#owl-carousel-link").owlCarousel({
        loop: true,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplayHoverPause: true,
        nav : true,
	  	navText : ['<div class="rny-arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>','<div class="rny-arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>'],
        pagination:false,
	  	dots : false,
	  	responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:true
			},
			1000:{
				items:6,
				nav:true
			}
		}
    });
	
	$(".rny-arrow-right-humas").bind("click", function (event) {
        event.preventDefault();
        $(".rny-vid-list-container-humas").stop().animate({
            scrollLeft: "+=536"
        }, 750);
    });
        
    $(".rny-arrow-left-humas").bind("click", function (event) {
        event.preventDefault();
        $(".rny-vid-list-container-humas").stop().animate({
            scrollLeft: "-=536"
        }, 750);
    });
	
	$(".rny-arrow-right").bind("click", function (event) {
        event.preventDefault();
        $(".rny-vid-list-container").stop().animate({
            scrollLeft: "+=536"
        }, 750);
    });
        
    $(".rny-arrow-left").bind("click", function (event) {
        event.preventDefault();
        $(".rny-vid-list-container").stop().animate({
            scrollLeft: "-=536"
        }, 750);
    });

});