<?php
/* Set custom Hybrid location. */
define( 'HYBRID_DIR', trailingslashit( dirname(__FILE__) ) . 'includes/hybrid/' );
define( 'HYBRID_URI', trailingslashit( get_template_directory_uri() ) . 'includes/hybrid/' );

/* Load the Hybrid Core framework and theme files. */
require_once( HYBRID_DIR . 'hybrid.php' );

/* Theme setup ie. menus, sidebars, image-sizes, additional scripts and styles. */
require_once( trailingslashit( dirname(__FILE__) ) . 'includes/theme.php' );

/* Launch the Hybrid Core framework. */
new Hybrid(); 

/* Get the theme rolling! */
EJOtheme::instantiate(); 