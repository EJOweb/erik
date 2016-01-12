<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<header <?php hybrid_attr( 'header' ); ?>>
			<div class="wrap">
				<div class="header-border"></div>

				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php hybrid_site_title(); ?>
					<?php /* <p id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></p> */ ?>
				</div><!-- #branding -->
				
				<?php hybrid_get_menu( 'primary-mobile' ); // Loads the menu/primary-mobile.php template. ?>
			</div><!-- .wrap -->

		</header><!-- #header -->

		<?php //hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>


		<div id="main" class="main">
			<div class="wrap">			
