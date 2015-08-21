<?php

final class Sobs_Three_Blocks_Widget extends WP_Widget
{
	//* Constructor. Set the default widget options and create widget.
	function __construct() 
	{
		$widget_title = 'Three blocks Widget';

		$widget_info = array(
			'classname'   => 'three-blocks-widget',
			'description' => 'Drie blokken met pagina-content.',
		);

		parent::__construct( 'three-blocks-widget', $widget_title, $widget_info );
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		echo $args['before_title'] . $instance['title'] . $args['after_title'];

		//* Defaults?! ?>

		<div class="blocks">

			<?php for ($i=1; $i<=3; $i++) { ?>

				<?php $page = get_post( $instance['page' . $i] ); ?>
				<div class="block">
					<h3><?php echo $page->post_title; ?></h3>
					<p><?php echo $page->post_excerpt; ?></p>
					<p><a href="<?php echo get_the_permalink($page->ID); ?>" class="button">Lees verder</a></p>
					<?php echo get_the_post_thumbnail($page->ID, 'thumbnail'); ?>
				</div>			

			<?php } ?>

		</div>

		<?php echo $args['after_widget'];
	}

 	public function form( $instance ) 
 	{
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$page1 = isset( $instance['page1'] ) ? $instance['page1'] : '';
		$page2 = isset( $instance['page2'] ) ? $instance['page2'] : '';
		$page3 = isset( $instance['page3'] ) ? $instance['page3'] : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php

		//* Get all pages
		$all_pages = get_pages();

		//* Show page dropdowns
		?>
		<p>
			<label>Pagina 1:</label> <?php $this->page_select('page1', $page1, $all_pages); ?>
			<br>
			<label>Pagina 2:</label> <?php $this->page_select('page2', $page2, $all_pages); ?>
			<br>
			<label>Pagina 3:</label> <?php $this->page_select('page3', $page3, $all_pages); ?>
			<br>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) 
	{
		//* Store old instance as defaults
		$instance = $old_instance;

		//* Store new title
		$instance['title'] = strip_tags( $new_instance['title'] );

		//* Store pages
		$instance['page1'] = $new_instance['page1'];
		$instance['page2'] = $new_instance['page2'];
		$instance['page3'] = $new_instance['page3'];
		
		return $instance;
	}

	public function page_select($field_name, $field_value, $all_pages = '')
	{
		if (empty($all_pages)) 
			$all_pages = get_pages();

		?>
		<select name="<?php echo $this->get_field_name($field_name); ?>">
			<?php
			foreach ($all_pages as $page) {
				$selected = selected($field_value, $page->ID, false);
				echo "<option value='".$page->ID."' ".$selected.">".$page->post_title."</option>";
			}
			?>
		</select>
		<?php
	}
}