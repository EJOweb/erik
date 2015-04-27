<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package    Erik
 * @subpackage Functions
 * @version    1.0.0
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2015, Erik Joling
 * @link       http://www.ejoweb.nl/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

//* Get the template directory and uri and make sure it has a trailing slash.
$theme_dir = trailingslashit( get_template_directory() );
$theme_uri = trailingslashit( get_template_directory_uri() );

//* Set custom Hybrid location.
define( 'HYBRID_DIR', $theme_dir . '_inc/hybrid/' );
define( 'HYBRID_URI', $theme_uri . '_inc/hybrid/' );

//* Load the Hybrid Core framework and theme files.
require_once( HYBRID_DIR . 'hybrid.php' );

//* Theme setup ie. menus, sidebars, image-sizes, additional scripts and styles.
require_once( $theme_dir . '_inc/theme.php' );

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
	define( 'THEME_IMG_URI', THEME_URI . '/assets/images/' );
	define( 'THEME_JS_URI', THEME_URI . '/assets/js/' );
	define( 'THEME_CSS_URI', THEME_URI . '/assets/css/' );

	//* Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	//* Better image grabbing
	add_theme_support( 'get-the-image' );

	//* Alternative to simple 'next/previous' links
	add_theme_support( 'loop-pagination' );

	//* Post formats.
	add_theme_support( 
		'post-formats', 
		array( 'quote' ) 
	);

	//* Handle content width for embeds and images.
	hybrid_set_content_width( 1280 );

	//* Remove more-link from cut-off excerpts
	add_filter( 'excerpt_more', 'erik_excerpt_more' );
}

//* Remove more-link from cut-off excerpts
function erik_excerpt_more( $more ) 
{
	return '... ';
}

//* show entry-details
function erik_entry_details()
{
	?>
	<div class="entry-details">
		<div class="wrap">
			<?php 
				$category = get_the_category();
				printf( '<a href="%s" title="%s" class="%s">%s</a>',
					get_category_link( $category[0]->term_id ),
					esc_attr( sprintf( __( "View all posts in %s" ), $category[0]->name ) ),
					"category",
					$category[0]->cat_name
				);
			?>
			<time <?php hybrid_attr( 'entry-published' ); ?>>
				<?php 
					$post_date = get_post_time( 'd-m-Y' );
					$today = date( 'd-m-Y' );
					$yesterday = date('d-m-Y',strtotime("-1 days"));

					if ($post_date == $today)
						echo '<i>Vandaag</i>';
					elseif ($post_date == $yesterday)
						echo '<i>Gisteren</i>';
					else 
						echo get_the_date() . '';
				?>
			</time>
			<span class="comments">
				0
			</span>
		</div>
	</div>
	<?php
}