<?php

add_action( 'admin_menu', 'register_image_slider_menu' );
add_action( 'admin_enqueue_scripts', 'image_slider_scripts' ); 
add_action( 'widgets_init', 'register_image_slider_widgets' );

/**
 * Add items to admin menu
 */
function register_image_slider_menu(){
	add_submenu_page('themes.php', 'Image Slider', 'Image Slider', 'edit_theme_options', 'ejo-image-slider', 'image_slider_content');
}

/**
 * Generate admin page
 */
function image_slider_content()
{
	include_once('admin/options-page.php');
}

/**
 * Add scripts to admin
 */
function image_slider_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'ejo-image-slider') {
		//* Add necessary media-library scripts
        wp_enqueue_media();
        wp_register_script('image-slider-admin-js', THEME_LIB_URI . '/extensions/sobs-image-slider/js/admin.js', array('jquery'));
        wp_enqueue_script('image-slider-admin-js');

        wp_enqueue_style( 'image-slider-admin-css', THEME_LIB_URI . '/extensions/sobs-image-slider/css/admin.css' );
    }
}

/**
 * Register widget(s)
 */
function register_image_slider_widgets() 
{ 
    //* Include Widget Classes
    include_once( 'widget-class.php' );
    register_widget( 'Image_Slider_Widget' ); 
}



