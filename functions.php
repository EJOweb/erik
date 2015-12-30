<?php
/**
 * @package    Erik
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2015, Erik Joling
 * @link       http://www.ejoweb.nl/
 */

//* Get the template directory and uri and make sure it has a trailing slash.
define( 'THEME_LIB_DIR', trailingslashit( get_template_directory() ) . '_build/' );
define( 'THEME_LIB_URI', trailingslashit( get_template_directory_uri() ) . '_build/' );

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
	//* Set Version
	define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );

	//* Set paths to asset folders.
	define( 'THEME_IMG_URI', trailingslashit( HYBRID_PARENT_URI ) . 'assets/images/' );
	define( 'THEME_JS_URI', trailingslashit( HYBRID_PARENT_URI ) . 'assets/js/' );
	define( 'THEME_CSS_URI', trailingslashit( HYBRID_PARENT_URI ) . 'assets/css/' );

	//* Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	//* Better image grabbing
	add_theme_support( 'get-the-image' );

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

	//* Remove URL from comment form
	add_filter('comment_form_default_fields', 'erik_comment_remove_url');
}

function erik_comment_remove_url($fields)
{
	unset($fields['url']);

	// $fields['author'] = '<p class="comment-form-author">' . 
	// 						'<input id="author" name="author" type="text" value="" size="30" aria-required="true" required="required" />' .
	// 						'<span class="highlight"></span>' .
 //      						'<span class="bar"></span>' .
	// 						'<label for="author">Naam <span class="required">*</span></label> ' .
	// 					'</p>';

	// $fields['email'] = 	'<p class="comment-form-email">' . 
	// 						'<input id="email" name="email" type="email" value="" size="30" aria-describedby="email-notes" aria-required="true" required="required" />' .
	// 						'<span class="highlight"></span>' .
 //      						'<span class="bar"></span>' .
	// 						'<label for="email">E-mail <span class="required">*</span></label> ' .
	// 					'</p>';

	// $fields['author'] = '<p class="comment-form-author">' .
	// 						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . 
	// 						'<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	// 					'</p>';

	// $fields['email'] = 	'<p class="comment-form-email">' .
 	// 						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
 	// 						'<label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	// 					'</p>';

	//* Extra honeypot form field to attract spam-bots
	$fields['is_legit'] = 	'<p class="comment-form-legit">' .
								'<label for="is-legit">Fill in if you\'re a spambot</label>' .
								'<input class="is-legit" name="is-legit" type="text" value="" />' . 
							'</p>';
	
	return $fields;
}
/**
 * Simple function to show comment info of a post
 * Output: [delimer] [link]Number of comments[/link]
 */
function ejo_show_comments_info()
{
	if (get_comments_number() > 0) :

		echo '<span class="delimiter">&bullet;</span> ';

		comments_popup_link( 
			'', 
			number_format_i18n( 1 ) . ' reactie', 
			'% reacties', 
			'comments-link', 
			'' 
		); 

	endif; // END check comments
}
