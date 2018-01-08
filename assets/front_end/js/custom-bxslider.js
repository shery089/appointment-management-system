// JavaScript Document

// DOM  starts here 

jQuery(document).ready(function($){
"use strict";

  $('.bxslider').bxSlider({
  	captions: true,
	nextText:'',
	prevText:'',
	 infiniteLoop: false,
     hideControlOnEnd : true,
     pager: false,
	 touchEnabled:true,
	 preloadImages:'all'
  });
});
// dom END