<?php

add_image_size( 'keurmerk', 9999, 50 );

add_action( 'admin_menu', 'register_keurmerken_admin_menu' );
add_action( 'admin_enqueue_scripts', 'keurmerken_admin_scripts_and_styles' ); 
add_action( 'widgets_init', 'register_keurmerken_widget' );


function register_keurmerken_admin_menu(){
	add_submenu_page(CHILD_SLUG, 'Keurmerken', 'Keurmerken', 'edit_theme_options', 'keurmerken', 'keurmerken_admin_content');
}

function keurmerken_admin_content()
{
	include_once('keurmerken-admin.php');
}

function keurmerken_admin_scripts_and_styles() {
    if (isset($_GET['page']) && $_GET['page'] == 'keurmerken') {
		//* Add necessary media-library scripts
        wp_enqueue_media();
        wp_register_script('keurmerken-admin-js', CHILD_INC_URL . '/theme-options/keurmerken/js/keurmerken-admin.js', array('jquery'));
        wp_enqueue_script('keurmerken-admin-js');

        wp_enqueue_style( 'keurmerken-admin-css', CHILD_INC_URL . '/theme-options/keurmerken/css/keurmerken-admin.css' );
    }
}

//* Register Keurmerken Widget
function register_keurmerken_widget() 
{ 
	register_widget( 'Keurmerken_Widget' ); 
}

//* Include Widget Classes
include_once( 'keurmerken-widget.php' );

//* Include Keurmerken functions
include_once( 'keurmerken-functions.php' );