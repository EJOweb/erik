<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>



<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(
		array(
			'prev_text' => 'Vorige',
			'next_text' => 'Volgende'
		)
	); ?>

<?php endif; // End check for type of page being viewed. ?>