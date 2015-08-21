jQuery(function($) {

	//* load script when window is loaded (including all images)
	$(window).load(function() {
		$('.image-slider-widget .marquee').marquee({
			duration: 15000,
			gap: 0,
			delayBeforeStart: 0,
			direction: 'left',
			duplicated: true,
			pauseOnHover: false
		});
	});

});