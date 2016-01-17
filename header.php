<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<?php locate_template( array( 'misc/header-image.php' ), true ); // Loads the misc/header-image.php template. ?>

		<header <?php hybrid_attr( 'header' ); ?>>
			<div class="wrap">
				<div class="header-border"></div>

				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php hybrid_site_title(); ?>
				</div><!-- #branding -->
				
				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
			</div><!-- .wrap -->
		</header><!-- #header -->

		<div id="main" class="main">
			<div class="wrap">			
