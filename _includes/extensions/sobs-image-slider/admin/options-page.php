<div class='wrap' style="max-width:960px;">
	<h2>Image Slider</h2>

	<?php

		//* options record met een lijst attachment id's en bijbehorende urls

		//* Nonces shizzle

		if ( isset($_POST['submit']) ) {

			//* Get send image slider entries
			$slides = (isset($_POST['image-slider'])) ? $_POST['image-slider'] : array();

			//* Reset array keys. [4] -> slide1, [2] -> slide2 becomes [0] -> slide1, [1] -> slide2
			$slides = array_values($slides);

			//* Save image slider data
			update_option( 'ejo_image_slider', $slides );

			//* Feedback to user
			echo '<div id="message" class="updated"><p><strong>De image slider is opgeslagen.</strong></p></div>';
			// echo '<pre>';print_r($slides);echo '</pre>';
		}

		//* Get image slider data from database. Return empty array if option not exists
		$slides = get_option( 'ejo_image_slider', array() );
		// echo '<pre>';print_r($slides);echo '</pre>';
	?>

	<!-- Slide Clone -->
	<table style="display:none;">
		<tr class="slide-clone">
			<td width="40">
				<div class="move-slide dashicons-before dashicons-sort"><br/></div>
			</td>
			<td width="180">
				<label>Slide</label>
				<input type="text" class="slide-name" name="image-slider[<?php echo count($slides); ?>][name]" value="" placeholder="Naam">
			</td>
			<td width="90">
				<div class="image-holder"></div>
			</td>
			<td width="125">
				<input type="button" class="button upload-image-button" value="Kies Afbeelding">
				<input type="hidden" class="upload-image-id" name="image-slider[<?php echo count($slides); ?>][image_id]" value="">
			</td>
			<td>
				<label>URL</label>
				<input type="text" class="slide-link" name="image-slider[<?php echo count($slides); ?>][link]" value="" placeholder="http://...">
			</td>
			<td width="40">
				<div class="remove-slide dashicons-before dashicons-dismiss"><br/></div>
			</td>
		</tr>
	</table>

	<form action="admin.php?page=ejo-image-slider" method="post">
		<!-- <input id="_wpnonce" type="hidden" value="" name="_wpnonce"> -->
		<p>
			<input id="" class="button button-primary" type="submit" value="Wijzigingen opslaan" name="submit">
			<a href="" class="button">Reset</a>
			<a id="add_slide" href="javascript:void(0)" class="button">Slide toevoegen</a>
		</p>

		<table class="form-table wp-list-table widefat image-slider-table">
			<tbody>
<?php
				foreach ($slides as $position => $slide_entry) {
?>
					<tr class="slide">
						<td width="40">
							<div class="move-slide dashicons-before dashicons-sort"><br/></div>
						</td>
						<td width="180">
							<label>Slide</label>
							<input type="text" class="slide-name" name="image-slider[<?php echo $position; ?>][name]" value="<?php echo isset($slide_entry['name']) ? $slide_entry['name'] : ''; ?>" placeholder="Naam">
						</td>
						<td width="90">
							<div class="image-holder"><?php echo wp_get_attachment_image( $slide_entry['image_id'], 'thumbnail' ); ?></div>
						</td>
						<td width="125">
							<input type="button" class="button upload-image-button" value="Kies Afbeelding">
							<input type="hidden" class="upload-image-id" name="image-slider[<?php echo $position; ?>][image_id]" value="<?php echo $slide_entry['image_id']; ?>">
						</td>
						<td>
							<label>URL</label>
							<input type="text" class="slide-link" name="image-slider[<?php echo $position; ?>][link]" value="<?php echo $slide_entry['link']; ?>" placeholder="http://...">
						</td>
						<td width="40">
							<div class="remove-slide dashicons-before dashicons-dismiss"><br/></div>
						</td>
					</tr>
<?php
				}
?>
			</tbody>
		</table>
		<p class="submit">
			<input id="submit" class="button button-primary" type="submit" value="Wijzigingen opslaan" name="submit">
		</p>
	</form>

</div>