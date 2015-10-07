<article <?php hybrid_attr( 'post' ); ?>>

	<?php $time = sprintf( "<time %s>%s</time>", hybrid_get_attr( 'entry-published' ), get_the_date() ); ?>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<div class="entry-byline">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
			<span class="delimiter">&bullet;</span>
			<?php echo $time; ?>
			<?php ejo_show_comments_info(); ?>
		</div>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php //hybrid_post_format_link(); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<div class="entry-byline">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
			<span class="delimiter">&bullet;</span>
			<?php echo $time; ?>			
			<?php ejo_show_comments_info(); ?>
		</div>

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<blockquote><?php echo get_the_excerpt(); ?></blockquote>
			
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php //hybrid_post_format_link(); ?>
			<a href="<?php the_permalink(); ?>" itemprop="url">Lees verder</a>
		</footer><!-- .entry-footer -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->