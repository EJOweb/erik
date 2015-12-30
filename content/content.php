<article <?php hybrid_attr( 'post' ); ?>>

	<?php $time = sprintf( "<time %s>%s</time>", hybrid_get_attr( 'entry-published' ), get_the_date() ); ?>

	<?php if ( is_singular() ) : // If a single post. ?>

		<div class="entry-byline">
			<a class="home-link" href="<?php echo site_url('/'); ?>"><i class="fa fa-home"></i></a> / <?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
			<span class="delimiter">&bullet;</span>
			<?php echo $time; ?>
			<?php ejo_show_comments_info(); ?>
		</div>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php the_title(); ?></h1>
		</header>

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php ejo_the_post_summary(); ?>

		</div><!-- .entry-content -->

	<?php else : // If not a single post. ?>

		<div class="entry-byline">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
			<span class="delimiter">&bullet;</span>
			<?php echo $time; ?>
			<?php ejo_show_comments_info(); ?>
		</div>

		<header class="entry-header">
			<h2 <?php hybrid_attr( 'entry-title' ); ?>><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			
			<?php ejo_the_post_summary(); ?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>" itemprop="url" class="button">Lees verder</a>
		</footer>

	<?php endif; // End single post check. ?>

</article><!-- .entry -->