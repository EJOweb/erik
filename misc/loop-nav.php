<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav">
		<?php previous_post_link( '<div class="prev">' . 'Previous Post: %link' . '</div>', '%title' ); ?>
		<?php next_post_link(     '<div class="next">' . 'Next Post: %link'  . '</div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(
		array( 
			'prev_text' => '&larr; Previous',
			'next_text' => 'Next &rarr;',
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>