<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, 
 * and lots of other awesome stuff that WordPress themes do.
 *
 * @package    Erik
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2015, Erik Joling
 * @link       http://www.ejoweb.nl/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register custom image sizes. */
add_action( 'init', 'erik_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'erik_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'erik_register_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'erik_enqueue_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'erik_enqueue_styles', 5 );

/* Excerpt-related filters. */
add_filter( 'excerpt_length', 'erik_excerpt_length' );
add_filter( 'excerpt_more',   'erik_excerpt_more'   );
add_filter( 'the_excerpt',    'erik_the_excerpt', 5 );

/**
 * Registers custom image sizes for the theme. 
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	//set_post_thumbnail_size( 150, 150, true );

	/* Adds the 'saga-large' image size. */
	add_image_size( 'erik-large', 1100, 9999, false );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_menus() {
	register_nav_menu( 'primary',    _x( 'Primary',    'nav menu location', 'hybrid-base' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'hybrid-base' ),
			'description' => __( 'Add sidebar description.', 'hybrid-base' )
		)
	);
}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_enqueue_scripts() {

	$suffix = hybrid_get_min_suffix();

	wp_register_script( 'erik', trailingslashit( ERIK_JS ) . "theme{$suffix}.js", array( 'jquery' ), null, true );

	wp_enqueue_script( 'erik' );	
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function erik_enqueue_styles() {

	/* Gets ".min" suffix. */
	$suffix = hybrid_get_min_suffix();

	/* Load one-five base style. */
	wp_enqueue_style( 'one-five', trailingslashit( HYBRID_CSS ) . "one-five{$suffix}.css" );

	/* Load Font Icon */
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0' );

	/* Load Font */
	wp_enqueue_style( 'erik-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic|Playfair+Display:400,700,900,400italic,700italic,900italic' );

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

/**
 * Adds a custom excerpt length.
 *
 * @since  1.0.0
 * @access public
 * @param  int     $length
 * @return int
 */
function erik_excerpt_length( $length ) {
	return 20;
}

/**
 * Custom excerpt more text and link.
 *
 * @since  1.2.0
 * @access public
 * @param  string  $more
 * @return string
 */
function erik_excerpt_more( $more ) {
	return ' &hellip; ';
}

/**
 * Appends a "Continue reading %s" link to the end of all excerpts.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $excerpt
 * @return string
 */
function erik_the_excerpt( $excerpt ) {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Continue reading %s', 'saga' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	$more = sprintf( '<p class="more-link-wrap"><a href="%s" class="more-link">%s</a></p>', get_permalink(), $text );

	return $excerpt . $more;
}
