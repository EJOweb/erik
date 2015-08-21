<?php

/* Image Slider Widget Class
--------------------------------------------- */
class Image_Slider_Widget extends WP_Widget {

	//* Holds widget settings defaults, populated in constructor.
	protected $defaults;

	//* Constructor. Set the default widget options and create widget.
	function __construct() 
	{
		$this->defaults = array(
			'title'	=> 'Image Slider Widget',
		);

		$widget_ops = array(
			'classname'   => 'image-slider-widget',
			'description' => 'Image Slider Widget',
		);

		$control_ops = array(
			'id_base' => 'image-slider-widget',
			'width'   => 505,
			'height'  => 350,
		);

		parent::__construct( 'image-slider-widget', 'Image Slider Widget', $widget_ops, $control_ops );

		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
	}

	function add_scripts()
	{
		wp_register_script('image-slider-widget-js', THEME_LIB_URI . '/extensions/sobs-image-slider/js/widget.js', array('jquery'));
        wp_enqueue_script('image-slider-widget-js');

        //* jQuery Marquee script
        wp_enqueue_script('jquery-marquee', THEME_LIB_URI . '/extensions/sobs-image-slider/js/jquery-marquee/jquery.marquee.js', array('jquery'));
	}
	
	//* Echo the widget content.
	function widget( $args, $instance ) {

		//* Get image slider data from database. Return empty array if option not exists
		$slides = get_option( 'ejo_image_slider', array() );

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		// if ( !empty($instance['title']) )
		// 	echo $args['before_title'] . $instance['title'] . $args['after_title'];

		echo '<div class="marquee">';
		echo '<ul class="image-slider">';
		foreach ($slides as $slide) {

			echo '<li class="slide">';

			echo (!empty($slide['link'])) ? '<a href="'. $slide['link'] .'" title="'. $slide['name'] .'">' : '' ;
			
			echo wp_get_attachment_image( $slide['image_id'], 'medium' );

			// echo 'Dit is een test.   |    ';

			echo (!empty($slide['link'])) ? '</a>' : '' ;

			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
		

		echo $args['after_widget'];

	}

	//* Update a particular instance.
	function update( $new_instance, $old_instance ) {

		$new_instance['title'] = strip_tags( $new_instance['title'] );

		return $new_instance;
	}

	//* Echo the settings update form.
	function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php
	}
}
?>