<?php
/**
 * Custom Meta Boxes for Slumber Falls Theme
 *
 * @package Slumber_Falls
 */

/**
 * Register Camp Details meta box
 */
function slumber_falls_add_camp_meta_boxes() {
	add_meta_box(
		'slumber_falls_camp_details',
		__( 'Camp Details', 'slumber-falls' ),
		'slumber_falls_camp_details_callback',
		'camp',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_camp_meta_boxes' );

/**
 * Render Camp Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_camp_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_camp_details_nonce', 'slumber_falls_camp_details_nonce_field' );

	// Get existing values.
	$start_date = get_post_meta( $post->ID, 'camp_start_date', true );
	$end_date   = get_post_meta( $post->ID, 'camp_end_date', true );
	$price      = get_post_meta( $post->ID, 'camp_price', true );
	$age_group  = get_post_meta( $post->ID, 'camp_age_group', true );
	$camp_type  = get_post_meta( $post->ID, 'camp_type', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="camp_start_date"><?php esc_html_e( 'Start Date', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="date"
					   id="camp_start_date"
					   name="camp_start_date"
					   value="<?php echo esc_attr( $start_date ); ?>"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Camp session start date (YYYY-MM-DD)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="camp_end_date"><?php esc_html_e( 'End Date', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="date"
					   id="camp_end_date"
					   name="camp_end_date"
					   value="<?php echo esc_attr( $end_date ); ?>"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Camp session end date (YYYY-MM-DD)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="camp_price"><?php esc_html_e( 'Price', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="camp_price"
					   name="camp_price"
					   value="<?php echo esc_attr( $price ); ?>"
					   placeholder="$450"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Camp price (e.g., $450)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="camp_age_group"><?php esc_html_e( 'Age Group', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="camp_age_group"
					   name="camp_age_group"
					   value="<?php echo esc_attr( $age_group ); ?>"
					   placeholder="Ages 8-12"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Target age range (e.g., Ages 8-12)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="camp_type"><?php esc_html_e( 'Camp Type', 'slumber-falls' ); ?></label></th>
			<td>
				<select id="camp_type" name="camp_type" class="regular-text">
					<option value=""><?php esc_html_e( 'Select Camp Type', 'slumber-falls' ); ?></option>
					<option value="overnight" <?php selected( $camp_type, 'overnight' ); ?>>
						<?php esc_html_e( 'Overnight', 'slumber-falls' ); ?>
					</option>
					<option value="day_camp" <?php selected( $camp_type, 'day_camp' ); ?>>
						<?php esc_html_e( 'Day Camp', 'slumber-falls' ); ?>
					</option>
					<option value="retreat" <?php selected( $camp_type, 'retreat' ); ?>>
						<?php esc_html_e( 'Retreat', 'slumber-falls' ); ?>
					</option>
				</select>
				<p class="description"><?php esc_html_e( 'Type of camp session', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Camp Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_camp_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_camp_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_camp_details_nonce_field'], 'slumber_falls_camp_details_nonce' ) ) {
		return;
	}

	// Check autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Sanitize and save Start Date.
	if ( isset( $_POST['camp_start_date'] ) ) {
		$start_date = sanitize_text_field( $_POST['camp_start_date'] );
		if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $start_date ) ) {
			update_post_meta( $post_id, 'camp_start_date', $start_date );
		} else {
			delete_post_meta( $post_id, 'camp_start_date' );
		}
	}

	// Sanitize and save End Date.
	if ( isset( $_POST['camp_end_date'] ) ) {
		$end_date = sanitize_text_field( $_POST['camp_end_date'] );
		if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $end_date ) ) {
			update_post_meta( $post_id, 'camp_end_date', $end_date );
		} else {
			delete_post_meta( $post_id, 'camp_end_date' );
		}
	}

	// Sanitize and save Price.
	if ( isset( $_POST['camp_price'] ) ) {
		update_post_meta( $post_id, 'camp_price', sanitize_text_field( $_POST['camp_price'] ) );
	}

	// Sanitize and save Age Group.
	if ( isset( $_POST['camp_age_group'] ) ) {
		update_post_meta( $post_id, 'camp_age_group', sanitize_text_field( $_POST['camp_age_group'] ) );
	}

	// Sanitize and save Camp Type.
	if ( isset( $_POST['camp_type'] ) ) {
		$camp_type     = sanitize_text_field( $_POST['camp_type'] );
		$allowed_types = array( 'overnight', 'day_camp', 'retreat', '' );
		if ( in_array( $camp_type, $allowed_types, true ) ) {
			update_post_meta( $post_id, 'camp_type', $camp_type );
		}
	}
}
add_action( 'save_post_camp', 'slumber_falls_save_camp_details' );
