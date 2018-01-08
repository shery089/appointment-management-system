

// ******************************************************************************************
// Configuration Start		
// ******************************************************************************************

//google MAP 
		var color = "#354008" // google map background colour
		var saturation = 100 // 
		var  Longitude=40.710892 //(Fist Value Longitude, Second Value Latitude), get YOUR coordenates here!: http://itouchmap.com/latlong.html
		var Latitude=-74.004920
		var marker_content="'<h5>Accura Vision</h5> #123 6th Avenue cross street, <br /> Princeton, NJ 36310" // marker or  on click content (Info Window) 
		var pointerUrl = 'assets/images/map-marker.png' // set your color pointer here!
		

/*****************************************************************************
		  		// Google map 
*****************************************************************************/

// DOM  starts here 
jQuery(document).ready(function($){
"use strict";
		//dragable mobile
		var drag;
		if($(window).width()<796){drag=false;}else{drag=true;}
		
	/* googleMaps */
	
			function map_canvas_loaded() {
			var latlng = new google.maps.LatLng(Longitude,Latitude);
			
			// setting styles here 
			var styles = [
				{
					"featureType": "landscape",
					"stylers": [
						{"hue": "#000"},
						{"saturation": -100},
						{"lightness": 40},
						{"gamma": 1}
					]
				},
				{
					"featureType": "road.highway",
					"stylers": [
						{"hue": color},
						{"saturation": saturation},
						{"lightness": 20},
						{"gamma": 1}
					]
				},
				{
					"featureType": "road.arterial",
					"stylers": [
						{"hue": color},
						{"saturation": saturation},
						{"lightness": -10},
						{"gamma": 1}
					]
				},
				{
					"featureType": "road.local",
					"stylers": [
						{"hue": color},
						{"saturation": saturation},
						{"lightness": 20},
						{"gamma": 1}
					]
				},
				{
					"featureType": "water",
					"stylers": [
						{"hue": "#000"},
						{"saturation": -100},
						{"lightness": 15},
						{"gamma": 1}
					]
				},
				{
					"featureType": "poi",
					"stylers": [
						{"hue": "#000"},
						{"saturation": -100},
						{"lightness": 25},
						{"gamma": 1}
					]
				}
			];		
			var options = {
			 center : latlng,
			 mapTypeId: google.maps.MapTypeId.ROADMAP,
			 zoom : 17,
			 styles: styles
			};
			var map_canvas = new google.maps.Map(document.getElementById('map_canvas'), options);
			var pointer = new google.maps.LatLng(Longitude,Latitude);
			var marker0= new google.maps.Marker({
			 position : pointer,
			 map : map_canvas,
			 icon: pointerUrl //Custom Pointer URL
			 });
			google.maps.event.addListener(marker0,'click',
			 function() {
			 var infowindow = new google.maps.InfoWindow(
			 {content:marker_content });
			 infowindow.open(map_canvas,marker0);
			 });
			}
			window.onload = function() {
			 map_canvas_loaded();
			};
		/* End */
		
		$('.show-googlemap').click(function(){
		if($(this).hasClass('plus')){
			$('.map_wrapper').animate({"height":'450px'},{queue:false,duration:700,easing:"easeInOutQuad"});
			setTimeout (function (){	
				$('html').scrollTo('.contact-text1',1000,{'axis':'y'});	
			}, 800 );
			$(this).removeClass('plus');
		}
		else{
			$(this).addClass('plus');
			$('.map_wrapper').animate({"height":'0'},{queue:false,duration:700,easing:"easeInOutQuad"});
		}
	});
	
	$('.map-close').click(function(){
		$('.show-googlemap').addClass('plus');
		$('.map_wrapper').animate({"height":'0'},{queue:false,duration:700,easing:"easeInOutQuad"});
	});
/* // Contact script */	

		
});
// dom END

