(function($){
	$(document).ready(function(){
		// Activate materialize dropdown menu
		$(".dropdown-button").dropdown({
			hover: true,
			constrain_width: false,
			belowOrigin: false
		});

		// Activate materialize sidenav menu
		$(".button-collapse").sideNav();
	});
})(jQuery);