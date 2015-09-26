<?php
/**
 * @package    Erik
 * @subpackage Functions
 * @version    1.0.0
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2015, Erik Joling
 * @link       http://www.ejoweb.nl/
 * @license    Not free...
 */

//* Get the template directory and uri and make sure it has a trailing slash.
define( 'THEME_LIB_DIR', trailingslashit( get_template_directory() ) . '_lib/' );
define( 'THEME_LIB_URI', trailingslashit( get_template_directory_uri() ) . '_lib/' );

//* Set custom Hybrid location.
define( 'HYBRID_DIR', THEME_LIB_DIR . 'hybrid/' );
define( 'HYBRID_URI', THEME_LIB_URI . 'hybrid/' );

//* Load the Hybrid Core framework and theme files.
require_once( HYBRID_DIR . 'hybrid.php' );

//* Theme setup ie. menus, sidebars, image-sizes, additional scripts and styles.
require_once( THEME_LIB_DIR . 'theme.php' );

//* Launch the Hybrid Core framework.
new Hybrid();


// *** BEGIN *** //

//* Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'erik_theme_setup', 5 );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_theme_setup() 
{	
	//* Set Textdomain with stylesheet 'text-domain'
	define( 'TEXT_DOMAIN', hybrid_get_parent_textdomain() );

	//* Set paths to asset folders.
	define( 'THEME_IMG_URI', HYBRID_PARENT_URI . 'assets/images/' );
	define( 'THEME_JS_URI', HYBRID_PARENT_URI );
	define( 'THEME_CSS_URI', HYBRID_PARENT_URI );

	//* Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	//* Better image grabbing
	add_theme_support( 'get-the-image' );

	//* Add breadcrumbs
	add_theme_support( 'breadcrumb-trail' );

	//* Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	//* Post formats.
	add_theme_support(
		'post-formats',
		array( 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	//* Custom Header
	$header_image_args = array(
		'width'         => 960,
		'height'        => 150,
		'uploads'   	=> true,
		'header-text'   => false,
	);
	add_theme_support( 'custom-header', $header_image_args );

	//* Filter excerpt_more
	add_filter( 'excerpt_more', function() { return '...'; } );
}