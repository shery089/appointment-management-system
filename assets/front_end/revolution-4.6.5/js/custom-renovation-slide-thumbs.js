

var revapi;

	// DOM  starts here 

jQuery(document).ready(function($){
"use strict";


			   revapi = jQuery('.tp-banner').revolution(
				{
					dottedOverlay:"rs-overlay",
					delay:9000,
					startwidth:1170,
					startheight:630,
					hideThumbs:10,
					fullWidth:"on",
					forceFullWidth:"on",
					navigationType:"none",
					navigationArrows:"",
					onHoverStop:"off"
				});

			   var slideThumb = $('.slide-thumbs');

				slideThumb.on('click', function(){
					var btn = $(this);
					revapi.revshowslide(btn.data('slide'));

				});
				revapi.bind("revolution.slide.onchange", function (e,data) {
					slideThumb.parent('li').removeClass('active');
					$('#slidethumb' + data.slideIndex).parent('li').addClass('active');
				});


$(".slider-thumbnails a").on('click', function() {
        return false;		
});

});
// dom END