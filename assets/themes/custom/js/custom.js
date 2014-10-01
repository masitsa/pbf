
	//smooth scroll
	smoothScroll.init();
$(document).ready(function() {
	
	//single page navigation
	$('#nav').onePageNav();
	
    //initialise Stellar.js
    $(window).stellar({
		horizontalScrolling: false
	}); 
	
	//WOW js
	new WOW().init();
	
	//Fit Vids
	$(".container").fitVids();
	
	//Owl Carousel
	var owl = $("#owl-carousel");
 
	owl.owlCarousel({
		items : 10, //10 items above 1824px browser width
		itemsDesktop : [1823,5], //5 items between 1823px and 1024px
		itemsDesktopSmall : [1023,3], // betweem 1023px and 601px
		itemsTablet: [600,2], //2 items between 600 and 0
		itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
	});
	 
	// Custom Navigation Events
	$(".next").click(function(){
		owl.trigger('owl.next');
	})
	$(".prev").click(function(){
		owl.trigger('owl.prev');
	})
});

