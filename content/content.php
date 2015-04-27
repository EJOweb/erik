<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( 'post' ) || is_archive() || is_home() ) : // If viewing a single post. ?>

	<div class="entry-details">
		<?php 
			$category = get_the_category();
			printf( '<a href="%s" title="%s" class="%s">%s</a>',
				get_category_link( $category[0]->term_id ),
				esc_attr( sprintf( __( "View all posts in %s" ), $category[0]->name ) ),
				"category",
				$category[0]->cat_name
			);
		?>
	</div>

	<?php endif; // End post-type check. ?>

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

		<header class="entry-header">
			<h2 <?php hybrid_attr( 'entry-title' ); ?>>
				<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
			</h2>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<p>
				<?php 
					$read_more_text = 'Lees verder';
					$excerpt = get_the_excerpt();
					echo $excerpt;

					if ( !has_excerpt() ) {
						$content = get_the_content();
						if ( $content == $excerpt )
							$read_more_text = 'Link';
					}
					// $read_more_text = '&raquo;';
				?>
				<!-- &raquo; <a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php echo $read_more_text; ?></a> -->
			</p>
		</div>

	<?php endif; // End single post check. ?>

	<footer class="entry-footer">
		<time <?php hybrid_attr( 'entry-published' ); ?>>
			<?php 
				$post_date = get_post_time( 'd-m-Y' );
				$today = date( 'd-m-Y' );
				$yesterday = date('d-m-Y',strtotime("-1 days"));

				if ($post_date == $today)
					echo '<i>Vandaag</i>';
				elseif ($post_date == $yesterday)
					echo '<i>Gisteren</i>';
				else 
					echo get_the_date() . '';
			?>
		</time>
		<span class="comments">
			0
		</span>
		<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php echo $read_more_text; ?></a>
	</footer>

</article><!-- .entry -->