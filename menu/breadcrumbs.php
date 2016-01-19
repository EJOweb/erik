<?php 
if ( function_exists('yoast_breadcrumb') ) {

	if (!is_front_page()) {

		yoast_breadcrumb(
			'<p class="breadcrumb-trail breadcrumbs">',
			'</p>'
		);

	}
}
?>