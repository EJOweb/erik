<?php $banner_image_class = (is_singular() && has_post_thumbnail()) ? 'banner-image': 'no-banner-image'; ?>

<div class="banner <?php echo $banner_image_class; ?>">
	<div class="wrap">

		<?php if (is_singular() && has_post_thumbnail()) : ?>

			<?php the_post_thumbnail( 'header' ); ?>

		<?php endif; //END post_thumbnail check ?>

		<div class="banner-blocks">
			<div class="banner-block-left"></div>
			<div class="banner-block-right"></div>
		</div>

		<div class="banner-shadow">
			<div class="wrap">

			</div>
		</div>
	</div>
</div>
