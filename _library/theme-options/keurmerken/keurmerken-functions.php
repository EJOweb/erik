<?php

function show_keurmerken() 
{
	//* Get keurmerken-data
	$keurmerken = get_option( 'theme_options_keurmerken' );
	$keurmerken = ($keurmerken !== false) ? $keurmerken : array();

	//* Abort if no keurmerken available
	if (empty($keurmerken))
		return;

	echo '<div class="keurmerken-container">';
	echo '<ul class="keurmerken">';
	foreach ($keurmerken as $keurmerk) {

		echo '<li class="keurmerk">';

		if (!empty($keurmerk['link']))
			echo '<a href="'. $keurmerk['link'] .'">';
		
		echo wp_get_attachment_image( $keurmerk['image_id'], 'keurmerk' );

		if (!empty($keurmerk['link']))
			echo '</a>';

		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
}