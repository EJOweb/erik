<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<header <?php hybrid_attr( 'header' ); ?>>

		<div class="branding-menu-container">
			<div class="wrap">

				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<h1><a href="<?php echo esc_url(home_url()); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php endif; ?>
					<span class="screen-reader-text" itemprop="name"><?php bloginfo( 'name' ); ?></span>
				</div><!-- #branding -->

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
				<?php //hybrid_get_menu( 'primary-mobile' ); // Loads the menu/primary-mobile.php template. ?>
			
			</div><!-- .wrap -->
		</div><!-- .branding-menu-container -->

		<div class="header-image">
			<div class="wrap">

				<img src="<?php header_image(); ?>" alt=""/>
				<div class="overlay"></div>

			</div><!-- .wrap -->
		</div><!-- .header-image -->

		<div class="header-content">
			<div class="wrap">

				<?php if (is_front_page()) : ?>

					<h1>Gewoon Nieuwsgierig</h1>
					
				<?php elseif (is_archive()) : ?>

					<h1 <?php hybrid_attr( 'archive-title' ); ?>><?php the_archive_title(); ?></h1>

				<?php else : ?>

					<h1>Test</h1>

				<?php endif; // End template check ?>

			</div><!-- .wrap -->
		</div><!-- .header-wrapper -->
		
	</header><!-- #header -->
