jQuery(document).ready(function($) {

	$('#toTop').click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

});