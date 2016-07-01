<article <?php hybrid_attr( 'post' ); ?>>

	<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>

	<header class="entry-header">

		<h1 <?php hybrid_attr( 'entry-title' ); ?>><span><?php single_post_title(); ?></span></h1>

	</header><!-- .entry-header -->

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- .entry -->