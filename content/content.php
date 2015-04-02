<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'hybrid-base' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'hybrid-base' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<span class="category">
			<?php 
				$category = get_the_category();
				printf( '<a href="%s" title="%s">%s</a>',
					get_category_link( $category[0]->term_id ),
					esc_attr( sprintf( __( "View all posts in %s" ), $category[0]->name ) ),
					$category[0]->cat_name
				);
			?>
		</span>			
		<header class="entry-header">
			<h2 <?php hybrid_attr( 'entry-title' ); ?>>
				<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
			</h2>
		</header><!-- .entry-header -->
		<time <?php hybrid_attr( 'entry-published' ); ?>><?php relative_post_the_date('','','',true); ?></time>


	<?php endif; // End single post check. ?>

</article><!-- .entry -->