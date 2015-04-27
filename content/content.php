<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
			<?php if ( !is_page() ) :?>
				<?php erik_entry_details(); ?>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

	<?php else : // If not viewing a single post. ?>

		<?php erik_entry_details(); ?>
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
				&raquo; <a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php echo $read_more_text; ?></a>
			</p>
		</div>

	<?php endif; // End single post check. ?>

</article><!-- .entry -->