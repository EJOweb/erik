/**
 * PAGINATION
 */

<?php
	$prev_posts_link = get_previous_posts_link( 'Vorige' );
	$next_posts_link = get_next_posts_link( 'Volgende' );
	$both_posts_links_class = ( empty($prev_posts_link) || empty($next_posts_link) ) ? 'one-way' : 'two-way';
?>
<div class="pagination <?php echo $both_posts_links_class; ?>">
	
	<?php if (!empty($prev_posts_link)) : ?>
		
		<div class="prev">
			<div class="icon-wrap">
				<i class="fa fa-arrow-left"></i>
			</div>
			<div class="link-wrap">
				<?php echo $prev_posts_link; ?>
			</div>
		</div>

	<?php endif; ?>

	<?php if (!empty($next_posts_link)) : ?>
		
		<div class="next">
			<div class="link-wrap">
				<?php echo $next_posts_link; ?>
			</div>
			<div class="icon-wrap">
				<i class="fa fa-arrow-right"></i>
			</div>
		</div>

	<?php endif; ?>

</div><!-- .pagination -->

<?php
	$older_post_link = get_previous_post_link( '%link' );
	$newer_post_link = get_next_post_link( '%link' );
	$both_post_links_class = ( empty($older_post_link) || empty($newer_post_link) ) ? 'one-way' : 'two-way';
?>
<div class="pagination <?php echo $both_post_links_class; ?>">
	
	<?php if (!empty($newer_post_link)) : ?>
		
		<div class="prev">
			<div class="icon-wrap">
				<i class="fa fa-arrow-left"></i>
			</div>
			<div class="link-wrap">
				<?php echo $newer_post_link; ?>
			</div>
		</div>

	<?php endif; ?>

	<?php if (!empty($older_post_link)) : ?>
		
		<div class="next">
			<div class="link-wrap">
				<?php echo $older_post_link; ?>
			</div>
			<div class="icon-wrap">
				<i class="fa fa-arrow-right"></i>
			</div>
		</div>

	<?php endif; ?>

</div><!-- .pagination -->