<li <?php hybrid_attr( 'comment' ); ?>>

	<article>
		<header class="comment-meta">
			<?php // echo get_avatar( $comment ); ?>
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite>
			&bullet;
			<?php $time = sprintf( "<time %s>%s</time>", hybrid_get_attr( 'entry-published' ), get_the_date() ); ?>
			<time <?php hybrid_attr( 'comment-published' ); ?>>
				<?php echo get_comment_time( 'j F \o\m G:i' ); ?>
			</time>
			&bullet;

			<!-- <a <?php hybrid_attr( 'comment-permalink' ); ?>><?php esc_html_e( 'Permalink', 'hybrid-base' ); ?></a> -->

			<?php //edit_comment_link(); ?>
			<?php hybrid_comment_reply_link( array( 'reply_text' => 'Reageren' )); ?>

		</header><!-- .comment-meta -->

		<div <?php hybrid_attr( 'comment-content' ); ?>>
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

	</article>

<?php // No closing </li> is needed.  WordPress will know where to add it. ?>