// DOM  starts here 
jQuery(document).ready(function($){
"use strict";


// Owl Slider
jQuery("#single-slider").owlCarousel({
	autoPlay: false, //Set AutoPlay to 3 seconds									  
      singleItem:true,
	  pagination:true,
	  navigation :true,
	  navigationText: [ "" ]
});
// Owl Slider

// Project slider
var carousel = $(".project-slider");
  carousel.owlCarousel({
	autoPlay:true,	   
	pagination : false,
	navigation : false,	   
	rewindNav : true,
	scrollPerPage : false,
	items :5,
	itemsDesktop : [1199,4],
	itemsDesktopSmall : [979,2],
	itemsTablet: [600,1], //2 items between 600 and 0
	navigationText: [ "" ]
});
  
// Patient Slider
$("#patient-slider").owlCarousel({
	autoPlay: 3000, //Set AutoPlay to 3 seconds
	pagination:true,
	items : 3,
	itemsDesktop : [1199,3],
	itemsDesktopSmall : [979,2],
	itemsTablet: [600,1] //2 items between 600 and 0
});
// Patient Slider

$(".slider-two-item").owlCarousel({
	autoPlay: 3000, //Set AutoPlay to 3 seconds
	pagination:true,
	items : 2,
	itemsDesktop : [1199,2],
	itemsDesktopSmall : [979,1],
	itemsTablet: [600,1] //2 items between 600 and 0
});

// Testimonial Slider
$(document).ready(function() {
      $("#testimonial-slider").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds									  
      singleItem:true,
	  pagination:true,
	  navigation :false

      });
    });
// Testimonial Slider

// Owl Slider Sidebar
jQuery("#sidebar-single-slider").owlCarousel({
	autoPlay: false, //Set AutoPlay to 3 seconds									  
      singleItem:true,
	  pagination:true,
	  navigation :true,
	  navigationText: [ "" ]
});
// Owl Slider

// Project slider
var carousel = $(".location-slider");
  carousel.owlCarousel({
	autoPlay:true,	   
	pagination : true,
	navigation : false, 
	scrollPerPage : false,
	items :3,
	itemsDesktop : [1199,3],
	itemsDesktopSmall : [979,2],
	itemsTablet: [600,1], //2 items between 600 and 0
	navigationText: [ "" ]
});

// Project Photos
jQuery(".project-photos").owlCarousel({
	autoPlay:true,	   
	pagination : false,
	navigation : true,	   
	rewindNav : true,
	scrollPerPage : false,
    singleItem : true,
    slideSpeed : 500,
	navigationText: [ "" ]
});

});
// dom END
