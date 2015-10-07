<?php
// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments-template">

	<?php if ( have_comments() ) : // Check if there are any comments. ?>

		<div id="comments">

			<!-- <h3 id="comments-number"><?php comments_number(); ?></h3> -->
			<h4 class="comments-title">Reacties</h4>

			<ol class="comment-list">
				<?php wp_list_comments(
					array(
						'style'        => 'ol',
						'callback'     => 'hybrid_comments_callback',
						'end-callback' => 'hybrid_comments_end_callback'
					)
				); ?>
			</ol><!-- .comment-list -->

			<?php locate_template( array( 'misc/comments-nav.php' ), true ); // Loads the misc/comments-nav.php template. ?>

		</div><!-- #comments-->

	<?php endif; // End check for comments. ?>

	<?php locate_template( array( 'misc/comments-error.php' ), true ); // Loads the misc/comments-error.php template. ?>

	<?php
		/*
		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'class_submit'      => 'submit',
			'name_submit'       => 'submit',
			'title_reply'       => __( 'Leave a Reply' ),
			'title_reply_to'    => __( 'Leave a Reply to %s' ),
			'cancel_reply_link' => __( 'Cancel Reply' ),
			'label_submit'      => __( 'Post Comment' ),
			'format'            => 'xhtml',

			'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
								'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
								'</textarea></p>',

			'must_log_in' => '<p class="must-log-in">' .
							sprintf(
							  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
							  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
							) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' .
							sprintf(
							__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
							  admin_url( 'profile.php' ),
							  $user_identity,
							  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
							) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' .
									__( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
									'</p>',

			'comment_notes_after' => '<p class="form-allowed-tags">' .
									sprintf(
									  __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
									  ' <code>' . allowed_tags() . '</code>'
									) . '</p>',

			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		);
		*/

		$args = array(
			// 'id_form'           => 'commentform',
			// 'id_submit'         => 'submit',
			// 'class_submit'      => 'submit',
			// 'name_submit'       => 'submit',
			// 'title_reply'       => __( 'Leave a Reply' ),
			// 'title_reply_to'    => __( 'Leave a Reply to %s' ),
			'cancel_reply_link' => '<i class="fa fa-remove"></i>',
			// 'label_submit'      => __( 'Post Comment' ),
			// 'format'            => 'xhtml',

			// 'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
			// 					'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			// 					'</textarea></p>',

			// 'must_log_in' => '<p class="must-log-in">' .
			// 				sprintf(
			// 				  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
			// 				  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			// 				) . '</p>',

			// 'logged_in_as' => '<p class="logged-in-as">' .
			// 				sprintf(
			// 				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
			// 				  admin_url( 'profile.php' ),
			// 				  $user_identity,
			// 				  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			// 				) . '</p>',

			'comment_notes_before' => '',

			'comment_notes_after' => '',

			// 'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		);

	?>

	<?php comment_form( $args ); // Loads the comment form. ?>

</section><!-- #comments-template -->