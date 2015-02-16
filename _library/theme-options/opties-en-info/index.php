<?php

add_action( 'admin_menu', 'ejo_register_theme_options_admin_menu' );

function ejo_register_theme_options_admin_menu(){
	add_menu_page( CHILD_NAME, CHILD_NAME, 'edit_theme_options', CHILD_SLUG, 'ejo_theme_options_content', '', 59.9 ); 
	add_submenu_page(CHILD_SLUG, 'Opties & Info', 'Opties & Info', 'edit_theme_options', CHILD_SLUG, 'ejo_theme_options_content');
}

function ejo_theme_options_content()
{
	include_once('opties-en-info.php');
}