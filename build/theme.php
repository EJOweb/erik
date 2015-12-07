<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, 
 * and lots of other awesome stuff that WordPress themes do.
 *
 * @package    Erik
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2015, Erik Joling
 * @link       http://www.ejoweb.nl/
 */

/* Register custom image sizes. */
add_action( 'init', 'erik_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'erik_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'erik_register_sidebars', 5 );

//* Remove styles & scripts
add_action( 'wp_print_styles', 'erik_remove_styles_and_scripts', 99 );

//* Add custom styles & scripts
add_action( 'wp_enqueue_scripts', 'erik_add_styles_and_scripts', 20 );

//* Spam prevention
add_action('preprocess_comment', 'preprocess_new_comment');

/**
 * Registers custom image sizes for the theme. 
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_image_sizes() 
{
	add_image_size( 'post_header_small', 720, 240, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_menus() 
{
	register_nav_menu( 'primary', 'Primary' );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_sidebars() 
{

}


/**
 * Remove scripts & stylesheets for the front end.
 */
function erik_remove_styles_and_scripts() 
{
	/* Gets ".min" suffix. */
	$suffix = hybrid_get_min_suffix();
}

/**
 * Load scripts & styles for the front end.
 */
function erik_add_styles_and_scripts() 
{
	$suffix = hybrid_get_min_suffix();

	//* Scripts
	wp_enqueue_script( 'theme', THEME_JS_URI . "theme{$suffix}.js", array( 'jquery' ), THEME_VERSION, true );

	//* Styles

	/* Load Font */
	wp_enqueue_style( 'theme-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,300italic,500,500italic|Roboto+Slab:700' );

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'theme', THEME_CSS_URI . "theme{$suffix}.css", false, THEME_VERSION );
}


/** 
 * Fuck off spammers
 * Check if extra honeypot form-field is filled in. If so, then disallow comment
 */ 
function preprocess_new_comment($commentdata) {
	if(!empty($_POST['is-legit'])) {
		die('You are bullshit');
	}
	return $commentdata;
}