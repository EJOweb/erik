<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, 
 * and lots of other awesome stuff that WordPress themes do.
 *
 * @package    EJOweb
 * @author     Erik Joling <erik@ejoweb.nl>
 * @copyright  Copyright (c) 2016, Erik Joling
 * @link       http://www.ejoweb.nl/
 */

/**
 *
 */
final class EJOtheme 
{
    /* Version number of this plugin */
    public static $version;

    /* Holds the instance of this class. */
    protected static $_instance = null;

    /* Store the id of this plugin */
    public static $id;

    /* Stores the theme path for this plugin. */
    public static $dir;

    /* Stores the theme URI for this plugin. */
    public static $uri;

    /* Stores the theme images URI for this plugin. */
    public static $img_uri;

    /* Stores the theme javascript URI for this plugin. */
    public static $js_uri;

    /* Stores the theme css URI for this plugin. */
    public static $css_uri;

    /* Returns the instance. */
    public static function instantiate() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    /* Plugin setup. */
    protected function __construct() 
    {
        /* Initialize */
        add_action( 'after_setup_theme', array( $this, 'initialize' ), 1 );

        /* Do theme setup on the 'after_setup_theme' hook. */
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ), 5 );
    }

    /**
     * Theme setup
     */
    public function initialize()
    {
		/* Set Version */
    	self::$version = wp_get_theme()->get( 'Version' );

		/* Set paths to asset folders. */
    	self::$img_uri = trailingslashit( HYBRID_PARENT_URI ) . 'assets/images/';
    	self::$js_uri = trailingslashit( HYBRID_PARENT_URI ) . 'assets/js/';
    	self::$css_uri = trailingslashit( HYBRID_PARENT_URI ) . 'assets/css/';
    }

    /**
	 * Theme setup function.  This function adds support for theme features and defines the default theme
	 * actions and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_setup() 
	{
		/**
		 * THEME SUPPORTS 
		 */

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

		/* Cleanup Backend */
		add_theme_support( 'ejo-cleanup-backend', array( 'widgets' ) );

		/* Cleanup Frontend */
		add_theme_support( 'ejo-cleanup-frontend', array( 'head', 'xmlrpc', 'pingback' ) );

		/* Allow admin to add scripts to entire site */
		add_theme_support( 'ejo-site-scripts' );

		/* Allow admin to add scripts to specific posts */
		add_theme_support( 'ejo-post-scripts' );

		/* Allow admin to add scripts */
		add_theme_support( 'ejo-social-links' );

		/* Improved Visual Editor */
		add_theme_support( 'ejo-tinymce', array('button', 'intro') );

		/**
		 * FILTERS
		 */

		//* Filter excerpt_more
		add_filter( 'excerpt_more', function() { return '...'; } );

		//* Remove URL from comment form
		add_filter( 'comment_form_default_fields', array( $this, 'edit_comment_form_default_fields' ) );

		/* Add custom image sizes to media dropdown */
		add_filter( 'image_size_names_choose', array( $this, 'image_sizes_list' ) );

		/**
		 * DEFAULT ACTIONS
		 */

		//* Remove styles & scripts
		add_action( 'wp_print_styles', array( $this, 'remove_styles_and_scripts' ), 99 );

		//* Add custom styles & scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'add_styles_and_scripts' ), 20 );

		/* Register custom image sizes. */
		add_action( 'init', array( $this, 'register_image_sizes' ), 5 );

		/* Register custom menus. */
		add_action( 'init', array( $this, 'register_menus' ), 5 );

		/* Register sidebars. */
		add_action( 'widgets_init', array( $this, 'register_sidebars' ), 5 );

		/* Add editor style */
		add_action( 'admin_init', array( $this, 'add_editor_styles' ) );


		/**
		 * CUSTOM ACTIONS
		 */

		//* Spam prevention
		add_action( 'preprocess_comment', array( $this, 'preprocess_new_comment') );

		/* Add style formats */
		add_filter( 'ejo_tinymce_style_formats', array( $this, 'extra_style_formats' ) );

	}

	/**
	 * Registers custom image sizes for the theme. 
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register_image_sizes() 
	{
		// add_image_size( 'banner', 960, 240, true ); 
		// add_image_size( 'featured', 480, 200, true ); 
		// add_image_size( 'header', 1200, 9999, true ); 
	}

	/**
	 * Add custom image sizes to media dropdown 
	 */
	public function image_sizes_list($sizes)
	{
		// $sizes['banner'] => 'Banner';

	    return $sizes;
	}


	/**
	 * Registers nav menu locations.
	 */
	public function register_menus() 
	{
		register_nav_menu( 'primary', 'Primary' );
	}

	/**
	 * Registers sidebars.
	 */
	public function register_sidebars() 
	{
		// hybrid_register_sidebar(
		// 	array(
		// 		'id'            => '',
		// 		'name'          => '',
		// 		'description'   => '',
		// 		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		// 		'after_widget'  => '</section>',
		// 		'before_title'  => '<h3 class="widget-title">',
		// 		'after_title'   => '</h3>'
		// 	)
		// );
	}

	/**
	 * Remove scripts & stylesheets for the front end.
	 */
	public function remove_styles_and_scripts() 
	{
		/* Gets ".min" suffix. */
		$suffix = hybrid_get_min_suffix();
	}

	/**
	 * Load scripts & styles for the front end.
	 */
	public function add_styles_and_scripts() 
	{
		$suffix = hybrid_get_min_suffix();

		//* Scripts
		wp_enqueue_script( 'theme', EJOtheme::$js_uri . "theme{$suffix}.js", array( 'jquery' ), EJOtheme::$version, true );

		//* Styles
		/* Load Font */
		wp_enqueue_style( 'theme-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,300italic,500,500italic|Roboto+Slab:700' );

		/* Load active theme stylesheet. */
		wp_enqueue_style( 'theme', EJOtheme::$css_uri . "theme{$suffix}.css", false, EJOtheme::$version );
	}

	/**
	 * Add editor style
	 */
	public function add_editor_styles()
	{
		$suffix = hybrid_get_min_suffix();

		/* External font */
		// $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Roboto:300,300italic,500,500italic|Roboto+Slab:700' );
		// add_editor_style( $font_url );

		/* Editor Style */
		// add_editor_style( THEME_CSS_URI . "editor-style{$suffix}.css?" . EJOtheme::$version );
	}

	/** 
	 * Add theme style formats
	 */
	public function extra_style_formats($style_formats)
	{
		/* Add button-class to anchors */
	    $style_formats[] =  array(
	        'title' => 'Button',
	        'selector' => 'a',
	        'classes' => 'button'
	    );

	    return $style_formats;
	}

	/**
	 * Remove url-field and add honeypot against bots
	 */
	public function edit_comment_form_default_fields($fields)
	{
		unset($fields['url']);

		//* Extra honeypot form field to attract spam-bots
		$fields['is_legit'] = 	'<p class="comment-form-legit">' .
									'<label for="is-legit">Fill in if you\'re a spambot</label>' .
									'<input class="is-legit" name="is-legit" type="text" value="" />' . 
								'</p>';
		
		return $fields;
	}

	/** 
	 * Fuck off spammers
	 * Check if extra honeypot form-field is filled in. If so, then disallow comment
	 */ 
	public function preprocess_new_comment($commentdata) {
		if(!empty($_POST['is-legit'])) {
			die('Bleep! Please do not comment..');
		}
		return $commentdata;
	}

	/**
	 * Simple function to show comment info of a post
	 * Output: [delimer] [link]Number of comments[/link]
	 */
	public function show_comments_info()
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
}


