<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<header <?php hybrid_attr( 'header' ); ?>> <?php // class="shrink" ?>
			<div class="wrap">

				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php hybrid_site_title(); ?>
					<!-- <p id="site-description"><?php bloginfo( 'description' ); ?></p> -->
				</div><!-- #branding -->

				<span class="menu-toggle">Menu</span>

			</div><!-- .wrap -->
			<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

		</header><!-- #header -->

		<div id="main" class="main">
			<div class="wrap">			
