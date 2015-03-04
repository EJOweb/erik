<div class='wrap' style="max-width:960px;">
	<h2>Keurmerken</h2>

	<?php

		//* options record met een lijst attachment id's en bijbehorende urls

		//* Nonces shizzle

		if ( isset($_POST['submit']) ) {

			//* Create temporary array of send keurmerken
			$tmp_keurmerken = (isset($_POST['keurmerken'])) ? $_POST['keurmerken'] : array();

			//* Iterativly stack keurmerken
			$keurmerken = array();
			foreach ($tmp_keurmerken as $position => $keurmerk) {
				$keurmerken[] = $keurmerk;
			}

			update_option( 'theme_options_keurmerken', $keurmerken );
			echo '<div id="message" class="updated"><p><strong>De keurmerken zijn opgeslagen.</strong></p></div>';
			// echo '<pre>';print_r($keurmerken);echo '</pre>';
		}

		$keurmerken = get_option( 'theme_options_keurmerken' );
		$keurmerken = ($keurmerken !== false) ? $keurmerken : array();
		// echo '<pre>';print_r($keurmerken);echo '</pre>';
	?>

	<!-- Keurmerk Clone -->
	<table style="display:none;">
		<tr class="keurmerk-clone">
			<td width="40">
				<div class="move-keurmerk dashicons-before dashicons-sort"><br/></div>
			</td>
			<td width="180">
				<label>Keurmerk</label>
				<input type="text" class="keurmerk-name" name="keurmerken[<?php echo count($keurmerken); ?>][name]" value="" placeholder="Naam">
			</td>
			<td width="150">
				<div class="image-holder"></div>
			</td>
			<td width="125">
				<input type="button" class="button upload-image-button" value="Kies Afbeelding">
				<input type="hidden" class="upload-image-id" name="keurmerken[<?php echo count($keurmerken); ?>][image_id]" value="">
			</td>
			<td>
				<label>URL</label>
				<input type="text" class="keurmerk-link" name="keurmerken[<?php echo count($keurmerken); ?>][link]" value="" placeholder="http://...">
			</td>
			<td width="40">
				<div class="remove-keurmerk dashicons-before dashicons-dismiss"><br/></div>
			</td>
		</tr>
	</table>

	<form action="admin.php?page=keurmerken" method="post">
		<!-- <input id="_wpnonce" type="hidden" value="" name="_wpnonce"> -->
		<p>
			<input id="" class="button button-primary" type="submit" value="Wijzigingen opslaan" name="submit">
			<a href="" class="button">Reset</a>
			<a id="add_keurmerk" href="javascript:void(0)" class="button">Keurmerk toevoegen</a>
		</p>

		<table class="form-table wp-list-table widefat keurmerken-table">
			<tbody>
<?php
				foreach ($keurmerken as $position => $keurmerk) {
?>
					<tr class="keurmerk">
						<td width="40">
							<div class="move-keurmerk dashicons-before dashicons-sort"><br/></div>
						</td>
						<td width="180">
							<label>Keurmerk</label>
							<input type="text" class="keurmerk-name" name="keurmerken[<?php echo $position; ?>][name]" value="<?php echo $keurmerk['name']; ?>" placeholder="Naam">
						</td>
						<td width="90">
							<div class="image-holder"><?php echo wp_get_attachment_image( $keurmerk['image_id'], 'keurmerk' ); ?></div>
						</td>
						<td width="125">
							<input type="button" class="button upload-image-button" value="Kies Afbeelding">
							<input type="hidden" class="upload-image-id" name="keurmerken[<?php echo $position; ?>][image_id]" value="<?php echo $keurmerk['image_id']; ?>">
						</td>
						<td>
							<label>URL</label>
							<input type="text" class="keurmerk-link" name="keurmerken[<?php echo $position; ?>][link]" value="<?php echo $keurmerk['link']; ?>" placeholder="http://...">
						</td>
						<td width="40">
							<div class="remove-keurmerk dashicons-before dashicons-dismiss"><br/></div>
						</td>
					</tr>
<?php
				}
?>
			</tbody>
		</table>
		<?php submit_button( 'Wijzigingen opslaan' ); ?>
	</form>

</div>
