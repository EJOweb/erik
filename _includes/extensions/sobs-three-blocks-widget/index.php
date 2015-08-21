<?php

add_action( 'widgets_init', 'register_sobs_three_blocks_widget' );

//* Register Widget
function register_sobs_three_blocks_widget() 
{ 
    //* Include Widget Class
    require_once( 'widget-class.php' );
    register_widget( 'Sobs_Three_Blocks_Widget' ); 
}



