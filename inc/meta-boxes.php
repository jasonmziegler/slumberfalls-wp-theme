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
	$featured   = get_post_meta( $post->ID, 'camp_featured', true );

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
		<tr>
			<th><label for="camp_featured"><?php esc_html_e( 'Featured Camp', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="checkbox"
					   id="camp_featured"
					   name="camp_featured"
					   value="1"
					   <?php checked( $featured, '1' ); ?>>
				<label for="camp_featured"><?php esc_html_e( 'Display "Featured" ribbon on camp archive', 'slumber-falls' ); ?></label>
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

	// Handle Featured checkbox.
	if ( isset( $_POST['camp_featured'] ) ) {
		update_post_meta( $post_id, 'camp_featured', '1' );
	} else {
		delete_post_meta( $post_id, 'camp_featured' );
	}
}
add_action( 'save_post_camp', 'slumber_falls_save_camp_details' );

/**
 * Register Instructor Details meta box
 */
function slumber_falls_add_instructor_meta_boxes() {
	add_meta_box(
		'slumber_falls_instructor_details',
		__( 'Instructor Details', 'slumber-falls' ),
		'slumber_falls_instructor_details_callback',
		'instructor',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_instructor_meta_boxes' );

/**
 * Render Instructor Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_instructor_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_instructor_details_nonce', 'slumber_falls_instructor_details_nonce_field' );

	// Get existing values.
	$credentials = get_post_meta( $post->ID, 'instructor_credentials', true );
	$years       = get_post_meta( $post->ID, 'instructor_years', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="instructor_credentials"><?php esc_html_e( 'Credentials/Qualifications', 'slumber-falls' ); ?></label></th>
			<td>
				<textarea
					id="instructor_credentials"
					name="instructor_credentials"
					rows="4"
					class="large-text"><?php echo esc_textarea( $credentials ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Certifications, qualifications, and experience (e.g., "Certified Lifeguard, 10 years experience")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="instructor_years"><?php esc_html_e( 'Years at Camp', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="instructor_years"
					   name="instructor_years"
					   value="<?php echo esc_attr( $years ); ?>"
					   placeholder="5 years"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Number of years at Slumber Falls (e.g., "5 years")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Instructor Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_instructor_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_instructor_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_instructor_details_nonce_field'], 'slumber_falls_instructor_details_nonce' ) ) {
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

	// Sanitize and save Credentials.
	if ( isset( $_POST['instructor_credentials'] ) ) {
		update_post_meta( $post_id, 'instructor_credentials', sanitize_textarea_field( $_POST['instructor_credentials'] ) );
	}

	// Sanitize and save Years at Camp.
	if ( isset( $_POST['instructor_years'] ) ) {
		update_post_meta( $post_id, 'instructor_years', sanitize_text_field( $_POST['instructor_years'] ) );
	}
}
add_action( 'save_post_instructor', 'slumber_falls_save_instructor_details' );

/**
 * Register Activity Details meta box
 */
function slumber_falls_add_activity_meta_boxes() {
	add_meta_box(
		'slumber_falls_activity_details',
		__( 'Activity Details', 'slumber-falls' ),
		'slumber_falls_activity_details_callback',
		'activity',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_activity_meta_boxes' );

/**
 * Render Activity Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_activity_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_activity_details_nonce', 'slumber_falls_activity_details_nonce_field' );

	// Get existing value.
	$category = get_post_meta( $post->ID, 'activity_category', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="activity_category"><?php esc_html_e( 'Category/Type', 'slumber-falls' ); ?></label></th>
			<td>
				<select id="activity_category" name="activity_category" class="regular-text">
					<option value=""><?php esc_html_e( 'Select Category', 'slumber-falls' ); ?></option>
					<option value="Outdoor Adventure" <?php selected( $category, 'Outdoor Adventure' ); ?>>
						<?php esc_html_e( 'Outdoor Adventure', 'slumber-falls' ); ?>
					</option>
					<option value="Water Sports" <?php selected( $category, 'Water Sports' ); ?>>
						<?php esc_html_e( 'Water Sports', 'slumber-falls' ); ?>
					</option>
					<option value="Arts & Crafts" <?php selected( $category, 'Arts & Crafts' ); ?>>
						<?php esc_html_e( 'Arts & Crafts', 'slumber-falls' ); ?>
					</option>
					<option value="Spiritual Growth" <?php selected( $category, 'Spiritual Growth' ); ?>>
						<?php esc_html_e( 'Spiritual Growth', 'slumber-falls' ); ?>
					</option>
					<option value="Team Building" <?php selected( $category, 'Team Building' ); ?>>
						<?php esc_html_e( 'Team Building', 'slumber-falls' ); ?>
					</option>
					<option value="Other" <?php selected( $category, 'Other' ); ?>>
						<?php esc_html_e( 'Other', 'slumber-falls' ); ?>
					</option>
				</select>
				<p class="description"><?php esc_html_e( 'Type of activity offered at camp', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Activity Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_activity_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_activity_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_activity_details_nonce_field'], 'slumber_falls_activity_details_nonce' ) ) {
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

	// Sanitize and save Category.
	if ( isset( $_POST['activity_category'] ) ) {
		$category         = sanitize_text_field( $_POST['activity_category'] );
		$allowed_categories = array( 'Outdoor Adventure', 'Water Sports', 'Arts & Crafts', 'Spiritual Growth', 'Team Building', 'Other', '' );
		if ( in_array( $category, $allowed_categories, true ) ) {
			update_post_meta( $post_id, 'activity_category', $category );
		}
	}
}
add_action( 'save_post_activity', 'slumber_falls_save_activity_details' );

/**
 * Register Location Details meta box
 */
function slumber_falls_add_location_meta_boxes() {
	add_meta_box(
		'slumber_falls_location_details',
		__( 'Location Details', 'slumber-falls' ),
		'slumber_falls_location_details_callback',
		'location',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_location_meta_boxes' );

/**
 * Render Location Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_location_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_location_details_nonce', 'slumber_falls_location_details_nonce_field' );

	// Get existing values.
	$address  = get_post_meta( $post->ID, 'location_address', true );
	$capacity = get_post_meta( $post->ID, 'location_capacity', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="location_address"><?php esc_html_e( 'Address', 'slumber-falls' ); ?></label></th>
			<td>
				<textarea
					id="location_address"
					name="location_address"
					rows="4"
					class="large-text"><?php echo esc_textarea( $address ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Full address for the location (e.g., "123 Camp Road, New Braunfels, TX 78130")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="location_capacity"><?php esc_html_e( 'Capacity', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="location_capacity"
					   name="location_capacity"
					   value="<?php echo esc_attr( $capacity ); ?>"
					   placeholder="50 campers"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Maximum capacity (e.g., "50 campers", "100 people")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Location Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_location_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_location_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_location_details_nonce_field'], 'slumber_falls_location_details_nonce' ) ) {
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

	// Sanitize and save Address.
	if ( isset( $_POST['location_address'] ) ) {
		update_post_meta( $post_id, 'location_address', sanitize_textarea_field( $_POST['location_address'] ) );
	}

	// Sanitize and save Capacity.
	if ( isset( $_POST['location_capacity'] ) ) {
		update_post_meta( $post_id, 'location_capacity', sanitize_text_field( $_POST['location_capacity'] ) );
	}
}
add_action( 'save_post_location', 'slumber_falls_save_location_details' );

/**
 * Register FAQ Details meta box
 */
function slumber_falls_add_faq_meta_boxes() {
	add_meta_box(
		'slumber_falls_faq_details',
		__( 'FAQ Details', 'slumber-falls' ),
		'slumber_falls_faq_details_callback',
		'faq',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_faq_meta_boxes' );

/**
 * Render FAQ Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_faq_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_faq_details_nonce', 'slumber_falls_faq_details_nonce_field' );

	// Get existing values.
	$category      = get_post_meta( $post->ID, 'faq_category', true );
	$display_order = get_post_meta( $post->ID, 'faq_display_order', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="faq_category"><?php esc_html_e( 'Category', 'slumber-falls' ); ?></label></th>
			<td>
				<select id="faq_category" name="faq_category" class="regular-text">
					<option value=""><?php esc_html_e( 'Select Category', 'slumber-falls' ); ?></option>
					<option value="Registration" <?php selected( $category, 'Registration' ); ?>>
						<?php esc_html_e( 'Registration', 'slumber-falls' ); ?>
					</option>
					<option value="Packing" <?php selected( $category, 'Packing' ); ?>>
						<?php esc_html_e( 'Packing', 'slumber-falls' ); ?>
					</option>
					<option value="Medical" <?php selected( $category, 'Medical' ); ?>>
						<?php esc_html_e( 'Medical', 'slumber-falls' ); ?>
					</option>
					<option value="Policies" <?php selected( $category, 'Policies' ); ?>>
						<?php esc_html_e( 'Policies', 'slumber-falls' ); ?>
					</option>
					<option value="General" <?php selected( $category, 'General' ); ?>>
						<?php esc_html_e( 'General', 'slumber-falls' ); ?>
					</option>
				</select>
				<p class="description"><?php esc_html_e( 'Category for grouping FAQs', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="faq_display_order"><?php esc_html_e( 'Display Order', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="number"
					   id="faq_display_order"
					   name="faq_display_order"
					   value="<?php echo esc_attr( $display_order ); ?>"
					   min="0"
					   step="1"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Lower numbers display first (e.g., 1, 2, 3...)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save FAQ Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_faq_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_faq_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_faq_details_nonce_field'], 'slumber_falls_faq_details_nonce' ) ) {
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

	// Sanitize and save Category.
	if ( isset( $_POST['faq_category'] ) ) {
		$category          = sanitize_text_field( $_POST['faq_category'] );
		$allowed_categories = array( 'Registration', 'Packing', 'Medical', 'Policies', 'General', '' );
		if ( in_array( $category, $allowed_categories, true ) ) {
			update_post_meta( $post_id, 'faq_category', $category );
		}
	}

	// Sanitize and save Display Order.
	if ( isset( $_POST['faq_display_order'] ) ) {
		$display_order = absint( $_POST['faq_display_order'] );
		update_post_meta( $post_id, 'faq_display_order', $display_order );
	}
}
add_action( 'save_post_faq', 'slumber_falls_save_faq_details' );

/**
 * Add Category column to FAQ admin list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function slumber_falls_add_faq_category_column( $columns ) {
	$new_columns = array();

	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;

		// Insert Category column after title.
		if ( 'title' === $key ) {
			$new_columns['faq_category'] = __( 'Category', 'slumber-falls' );
		}
	}

	return $new_columns;
}
add_filter( 'manage_faq_posts_columns', 'slumber_falls_add_faq_category_column' );

/**
 * Populate Category column in FAQ admin list
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function slumber_falls_populate_faq_category_column( $column, $post_id ) {
	if ( 'faq_category' === $column ) {
		$category = get_post_meta( $post_id, 'faq_category', true );
		echo $category ? esc_html( $category ) : '<span style="color: #999;">—</span>';
	}
}
add_action( 'manage_faq_posts_custom_column', 'slumber_falls_populate_faq_category_column', 10, 2 );

/**
 * Register Testimonial Details meta box
 */
function slumber_falls_add_testimonial_meta_boxes() {
	add_meta_box(
		'slumber_falls_testimonial_details',
		__( 'Testimonial Details', 'slumber-falls' ),
		'slumber_falls_testimonial_details_callback',
		'testimonial',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_testimonial_meta_boxes' );

/**
 * Render Testimonial Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_testimonial_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_testimonial_details_nonce', 'slumber_falls_testimonial_details_nonce_field' );

	// Get existing values.
	$name     = get_post_meta( $post->ID, 'testimonial_name', true );
	$year     = get_post_meta( $post->ID, 'testimonial_year', true );
	$featured = get_post_meta( $post->ID, 'testimonial_featured', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="testimonial_name"><?php esc_html_e( 'Parent/Camper Name', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="testimonial_name"
					   name="testimonial_name"
					   value="<?php echo esc_attr( $name ); ?>"
					   placeholder="Sarah M."
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Name of parent or camper providing testimonial (e.g., "Sarah M.")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="testimonial_year"><?php esc_html_e( 'Year Attended', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="testimonial_year"
					   name="testimonial_year"
					   value="<?php echo esc_attr( $year ); ?>"
					   placeholder="Summer 2025"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Year or season attended (e.g., "Summer 2025")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="testimonial_featured"><?php esc_html_e( 'Featured', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="checkbox"
					   id="testimonial_featured"
					   name="testimonial_featured"
					   value="1"
					   <?php checked( $featured, '1' ); ?>>
				<label for="testimonial_featured"><?php esc_html_e( 'Display this testimonial on the homepage', 'slumber-falls' ); ?></label>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Testimonial Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_testimonial_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_testimonial_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_testimonial_details_nonce_field'], 'slumber_falls_testimonial_details_nonce' ) ) {
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

	// Auto-generate post title from testimonial name to avoid "Auto Draft".
	if ( isset( $_POST['testimonial_name'] ) ) {
		$name = sanitize_text_field( $_POST['testimonial_name'] );
		if ( ! empty( $name ) ) {
			// Remove the action to prevent infinite loop.
			remove_action( 'save_post_testimonial', 'slumber_falls_save_testimonial_details' );

			// Update post title.
			wp_update_post( array(
				'ID'         => $post_id,
				'post_title' => 'Testimonial - ' . $name,
			) );

			// Re-add the action.
			add_action( 'save_post_testimonial', 'slumber_falls_save_testimonial_details' );
		}
	}

	// Sanitize and save Name.
	if ( isset( $_POST['testimonial_name'] ) ) {
		update_post_meta( $post_id, 'testimonial_name', sanitize_text_field( $_POST['testimonial_name'] ) );
	}

	// Sanitize and save Year.
	if ( isset( $_POST['testimonial_year'] ) ) {
		update_post_meta( $post_id, 'testimonial_year', sanitize_text_field( $_POST['testimonial_year'] ) );
	}

	// Handle Featured checkbox.
	if ( isset( $_POST['testimonial_featured'] ) ) {
		update_post_meta( $post_id, 'testimonial_featured', '1' );
	} else {
		delete_post_meta( $post_id, 'testimonial_featured' );
	}
}
add_action( 'save_post_testimonial', 'slumber_falls_save_testimonial_details' );

/**
 * Register Facility Details meta box
 */
function slumber_falls_add_facility_meta_boxes() {
	add_meta_box(
		'slumber_falls_facility_details',
		__( 'Facility Details', 'slumber-falls' ),
		'slumber_falls_facility_details_callback',
		'facility',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_facility_meta_boxes' );

/**
 * Render Facility Details meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_facility_details_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_facility_details_nonce', 'slumber_falls_facility_details_nonce_field' );

	// Get existing values.
	$capacity           = get_post_meta( $post->ID, 'facility_capacity', true );
	$amenities          = get_post_meta( $post->ID, 'facility_amenities', true );
	$available_retreats = get_post_meta( $post->ID, 'facility_available_retreats', true );

	?>
	<table class="form-table">
		<tr>
			<th><label for="facility_capacity"><?php esc_html_e( 'Capacity', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text"
					   id="facility_capacity"
					   name="facility_capacity"
					   value="<?php echo esc_attr( $capacity ); ?>"
					   placeholder="100 people"
					   class="regular-text">
				<p class="description"><?php esc_html_e( 'Maximum capacity (e.g., "100 people", "50-75")', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="facility_amenities"><?php esc_html_e( 'Amenities', 'slumber-falls' ); ?></label></th>
			<td>
				<textarea
					id="facility_amenities"
					name="facility_amenities"
					rows="5"
					class="large-text"><?php echo esc_textarea( $amenities ); ?></textarea>
				<p class="description"><?php esc_html_e( 'List of amenities and features (comma-separated or one per line)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="facility_available_retreats"><?php esc_html_e( 'Available for Retreats', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="checkbox"
					   id="facility_available_retreats"
					   name="facility_available_retreats"
					   value="1"
					   <?php checked( $available_retreats, '1' ); ?>>
				<label for="facility_available_retreats"><?php esc_html_e( 'This facility is available for group retreats', 'slumber-falls' ); ?></label>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Facility Details meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_facility_details( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_facility_details_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_facility_details_nonce_field'], 'slumber_falls_facility_details_nonce' ) ) {
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

	// Sanitize and save Capacity.
	if ( isset( $_POST['facility_capacity'] ) ) {
		update_post_meta( $post_id, 'facility_capacity', sanitize_text_field( $_POST['facility_capacity'] ) );
	}

	// Sanitize and save Amenities.
	if ( isset( $_POST['facility_amenities'] ) ) {
		update_post_meta( $post_id, 'facility_amenities', sanitize_textarea_field( $_POST['facility_amenities'] ) );
	}

	// Handle Available for Retreats checkbox.
	if ( isset( $_POST['facility_available_retreats'] ) ) {
		update_post_meta( $post_id, 'facility_available_retreats', '1' );
	} else {
		delete_post_meta( $post_id, 'facility_available_retreats' );
	}
}
add_action( 'save_post_facility', 'slumber_falls_save_facility_details' );

/**
 * Register Camp Instructors meta box
 */
function slumber_falls_add_camp_instructors_meta_box() {
	add_meta_box(
		'slumber_falls_camp_instructors',
		__( 'Assign Instructors', 'slumber-falls' ),
		'slumber_falls_camp_instructors_callback',
		'camp',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_camp_instructors_meta_box' );

/**
 * Render Camp Instructors meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_camp_instructors_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_camp_instructors_nonce', 'slumber_falls_camp_instructors_nonce_field' );

	// Get currently assigned instructors.
	$assigned_instructors = get_post_meta( $post->ID, 'camp_instructors', true );
	if ( ! is_array( $assigned_instructors ) ) {
		$assigned_instructors = array();
	}

	// Query all published instructors.
	$instructors = get_posts(
		array(
			'post_type'      => 'instructor',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	if ( ! empty( $instructors ) ) {
		echo '<div class="slumber-falls-instructors-list">';
		foreach ( $instructors as $instructor ) {
			$checked = in_array( $instructor->ID, $assigned_instructors, true ) ? 'checked' : '';
			?>
			<label style="display: block; margin-bottom: 8px;">
				<input type="checkbox"
					   name="camp_instructors[]"
					   value="<?php echo absint( $instructor->ID ); ?>"
					   <?php echo esc_attr( $checked ); ?>>
				<?php echo esc_html( $instructor->post_title ); ?>
			</label>
			<?php
		}
		echo '</div>';
	} else {
		echo '<p>' . esc_html__( 'No instructors found. Create instructors first.', 'slumber-falls' ) . '</p>';
	}
}

/**
 * Save Camp Instructors meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_camp_instructors( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_camp_instructors_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_camp_instructors_nonce_field'], 'slumber_falls_camp_instructors_nonce' ) ) {
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

	// Get and sanitize instructor IDs.
	if ( isset( $_POST['camp_instructors'] ) && is_array( $_POST['camp_instructors'] ) ) {
		$instructors = array_map( 'absint', $_POST['camp_instructors'] );
		update_post_meta( $post_id, 'camp_instructors', $instructors );
	} else {
		// No instructors selected, delete the meta.
		delete_post_meta( $post_id, 'camp_instructors' );
	}
}
add_action( 'save_post_camp', 'slumber_falls_save_camp_instructors' );

/**
 * Register Camp Activities meta box
 */
function slumber_falls_add_camp_activities_meta_box() {
	add_meta_box(
		'slumber_falls_camp_activities',
		__( 'Assign Activities', 'slumber-falls' ),
		'slumber_falls_camp_activities_callback',
		'camp',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_camp_activities_meta_box' );

/**
 * Render Camp Activities meta box content
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_camp_activities_callback( $post ) {
	// Add nonce field for security.
	wp_nonce_field( 'slumber_falls_camp_activities_nonce', 'slumber_falls_camp_activities_nonce_field' );

	// Get currently assigned activities.
	$assigned_activities = get_post_meta( $post->ID, 'camp_activities', true );
	if ( ! is_array( $assigned_activities ) ) {
		$assigned_activities = array();
	}

	// Query all published activities.
	$activities = get_posts(
		array(
			'post_type'      => 'activity',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	if ( ! empty( $activities ) ) {
		echo '<div class="slumber-falls-activities-list">';
		foreach ( $activities as $activity ) {
			$checked = in_array( $activity->ID, $assigned_activities, true ) ? 'checked' : '';
			?>
			<label style="display: block; margin-bottom: 8px;">
				<input type="checkbox"
					   name="camp_activities[]"
					   value="<?php echo absint( $activity->ID ); ?>"
					   <?php echo esc_attr( $checked ); ?>>
				<?php echo esc_html( $activity->post_title ); ?>
			</label>
			<?php
		}
		echo '</div>';
	} else {
		echo '<p>' . esc_html__( 'No activities found. Create activities first.', 'slumber-falls' ) . '</p>';
	}
}

/**
 * Save Camp Activities meta box data
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_camp_activities( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_camp_activities_nonce_field'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_camp_activities_nonce_field'], 'slumber_falls_camp_activities_nonce' ) ) {
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

	// Get and sanitize activity IDs.
	if ( isset( $_POST['camp_activities'] ) && is_array( $_POST['camp_activities'] ) ) {
		$activities = array_map( 'absint', $_POST['camp_activities'] );
		update_post_meta( $post_id, 'camp_activities', $activities );
	} else {
		// No activities selected, delete the meta.
		delete_post_meta( $post_id, 'camp_activities' );
	}
}
add_action( 'save_post_camp', 'slumber_falls_save_camp_activities' );

/**
 * Add Team Members meta box to About page.
 */
function slumber_falls_add_team_members_meta_box() {
	add_meta_box(
		'slumber_falls_team_members',
		__( 'Team Members', 'slumber-falls' ),
		'slumber_falls_team_members_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'slumber_falls_add_team_members_meta_box' );

/**
 * Team Members meta box callback.
 *
 * @param WP_Post $post The post object.
 */
function slumber_falls_team_members_callback( $post ) {
	// Add nonce for security.
	wp_nonce_field( 'slumber_falls_save_team_members', 'slumber_falls_team_members_nonce' );

	// Get existing values.
	$director_photo    = get_post_meta( $post->ID, 'director_photo', true );
	$director_bio      = get_post_meta( $post->ID, 'director_bio', true );
	$program_dir_photo = get_post_meta( $post->ID, 'program_director_photo', true );
	$program_dir_bio   = get_post_meta( $post->ID, 'program_director_bio', true );
	?>

	<div class="slumber-falls-team-members-meta">

		<!-- Camp Director Section -->
		<h3 style="margin-top: 1em; border-bottom: 1px solid #ddd; padding-bottom: 0.5em;">
			<?php esc_html_e( 'Camp Director', 'slumber-falls' ); ?>
		</h3>

		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="director_photo">
						<?php esc_html_e( 'Director Photo', 'slumber-falls' ); ?>
					</label>
				</th>
				<td>
					<div class="image-upload-wrap">
						<input type="hidden" id="director_photo" name="director_photo" value="<?php echo esc_attr( $director_photo ); ?>" />
						<div class="image-preview">
							<?php if ( $director_photo ) : ?>
								<img src="<?php echo esc_url( wp_get_attachment_url( $director_photo ) ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" />
							<?php endif; ?>
						</div>
						<button type="button" class="button upload-image-button" data-field="director_photo">
							<?php echo $director_photo ? esc_html__( 'Change Photo', 'slumber-falls' ) : esc_html__( 'Upload Photo', 'slumber-falls' ); ?>
						</button>
						<?php if ( $director_photo ) : ?>
							<button type="button" class="button remove-image-button" data-field="director_photo">
								<?php esc_html_e( 'Remove Photo', 'slumber-falls' ); ?>
							</button>
						<?php endif; ?>
					</div>
					<p class="description">
						<?php esc_html_e( 'Upload a photo of the Camp Director. Recommended size: 400x400px.', 'slumber-falls' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="director_bio">
						<?php esc_html_e( 'Director Bio', 'slumber-falls' ); ?>
					</label>
				</th>
				<td>
					<textarea id="director_bio" name="director_bio" rows="5" class="large-text"><?php echo esc_textarea( $director_bio ); ?></textarea>
					<p class="description">
						<?php esc_html_e( 'Enter a brief biography for the Camp Director (2-3 sentences).', 'slumber-falls' ); ?>
					</p>
				</td>
			</tr>
		</table>

		<!-- Program Director Section -->
		<h3 style="margin-top: 2em; border-bottom: 1px solid #ddd; padding-bottom: 0.5em;">
			<?php esc_html_e( 'Program Director', 'slumber-falls' ); ?>
		</h3>

		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="program_director_photo">
						<?php esc_html_e( 'Program Director Photo', 'slumber-falls' ); ?>
					</label>
				</th>
				<td>
					<div class="image-upload-wrap">
						<input type="hidden" id="program_director_photo" name="program_director_photo" value="<?php echo esc_attr( $program_dir_photo ); ?>" />
						<div class="image-preview">
							<?php if ( $program_dir_photo ) : ?>
								<img src="<?php echo esc_url( wp_get_attachment_url( $program_dir_photo ) ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" />
							<?php endif; ?>
						</div>
						<button type="button" class="button upload-image-button" data-field="program_director_photo">
							<?php echo $program_dir_photo ? esc_html__( 'Change Photo', 'slumber-falls' ) : esc_html__( 'Upload Photo', 'slumber-falls' ); ?>
						</button>
						<?php if ( $program_dir_photo ) : ?>
							<button type="button" class="button remove-image-button" data-field="program_director_photo">
								<?php esc_html_e( 'Remove Photo', 'slumber-falls' ); ?>
							</button>
						<?php endif; ?>
					</div>
					<p class="description">
						<?php esc_html_e( 'Upload a photo of the Program Director. Recommended size: 400x400px.', 'slumber-falls' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="program_director_bio">
						<?php esc_html_e( 'Program Director Bio', 'slumber-falls' ); ?>
					</label>
				</th>
				<td>
					<textarea id="program_director_bio" name="program_director_bio" rows="5" class="large-text"><?php echo esc_textarea( $program_dir_bio ); ?></textarea>
					<p class="description">
						<?php esc_html_e( 'Enter a brief biography for the Program Director (2-3 sentences).', 'slumber-falls' ); ?>
					</p>
				</td>
			</tr>
		</table>
	</div>

	<script>
	jQuery(document).ready(function($) {
		// Image upload functionality
		$('.upload-image-button').on('click', function(e) {
			e.preventDefault();
			var button = $(this);
			var fieldId = button.data('field');
			var field = $('#' + fieldId);
			var preview = button.siblings('.image-preview');

			var uploader = wp.media({
				title: '<?php esc_html_e( 'Upload Team Member Photo', 'slumber-falls' ); ?>',
				button: {
					text: '<?php esc_html_e( 'Use this photo', 'slumber-falls' ); ?>'
				},
				multiple: false
			});

			uploader.on('select', function() {
				var attachment = uploader.state().get('selection').first().toJSON();
				field.val(attachment.id);
				preview.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" />');
				button.text('<?php esc_html_e( 'Change Photo', 'slumber-falls' ); ?>');

				// Add remove button if it doesn't exist
				if (!button.siblings('.remove-image-button').length) {
					button.after('<button type="button" class="button remove-image-button" data-field="' + fieldId + '"><?php esc_html_e( 'Remove Photo', 'slumber-falls' ); ?></button>');
				}
			});

			uploader.open();
		});

		// Image remove functionality (delegated)
		$(document).on('click', '.remove-image-button', function(e) {
			e.preventDefault();
			var button = $(this);
			var fieldId = button.data('field');
			var field = $('#' + fieldId);
			var preview = button.siblings('.image-preview');
			var uploadButton = button.siblings('.upload-image-button');

			field.val('');
			preview.html('');
			uploadButton.text('<?php esc_html_e( 'Upload Photo', 'slumber-falls' ); ?>');
			button.remove();
		});
	});
	</script>
	<?php
}

/**
 * Save Team Members meta box data.
 *
 * @param int $post_id The post ID.
 */
function slumber_falls_save_team_members( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['slumber_falls_team_members_nonce'] ) ) {
		return;
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['slumber_falls_team_members_nonce'], 'slumber_falls_save_team_members' ) ) {
		return;
	}

	// Check for autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save Camp Director photo.
	if ( isset( $_POST['director_photo'] ) ) {
		update_post_meta( $post_id, 'director_photo', absint( $_POST['director_photo'] ) );
	} else {
		delete_post_meta( $post_id, 'director_photo' );
	}

	// Save Camp Director bio.
	if ( isset( $_POST['director_bio'] ) ) {
		update_post_meta( $post_id, 'director_bio', sanitize_textarea_field( $_POST['director_bio'] ) );
	} else {
		delete_post_meta( $post_id, 'director_bio' );
	}

	// Save Program Director photo.
	if ( isset( $_POST['program_director_photo'] ) ) {
		update_post_meta( $post_id, 'program_director_photo', absint( $_POST['program_director_photo'] ) );
	} else {
		delete_post_meta( $post_id, 'program_director_photo' );
	}

	// Save Program Director bio.
	if ( isset( $_POST['program_director_bio'] ) ) {
		update_post_meta( $post_id, 'program_director_bio', sanitize_textarea_field( $_POST['program_director_bio'] ) );
	} else {
		delete_post_meta( $post_id, 'program_director_bio' );
	}
}
add_action( 'save_post_page', 'slumber_falls_save_team_members' );

/**
 * Register Pre-Footer CTA meta box on pages and CPT single posts.
 */
function slumber_falls_add_pre_footer_cta_meta_box() {
	$post_types = array( 'page', 'camp', 'facility', 'activity', 'instructor' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'slumber_falls_pre_footer_cta',
			__( 'Pre-Footer CTA', 'slumber-falls' ),
			'slumber_falls_pre_footer_cta_callback',
			$post_type,
			'normal',
			'default'
		);
	}
}
add_action( 'add_meta_boxes', 'slumber_falls_add_pre_footer_cta_meta_box' );

/**
 * Render Pre-Footer CTA meta box content.
 *
 * @param WP_Post $post Current post object.
 */
function slumber_falls_pre_footer_cta_callback( $post ) {
	wp_nonce_field( 'slumber_falls_pre_footer_cta_nonce', 'slumber_falls_pre_footer_cta_nonce_field' );

	$hide       = get_post_meta( $post->ID, 'pre_footer_cta_hide', true );
	$heading    = get_post_meta( $post->ID, 'pre_footer_cta_heading', true );
	$subtext    = get_post_meta( $post->ID, 'pre_footer_cta_subtext', true );
	$btn1_label = get_post_meta( $post->ID, 'pre_footer_cta_btn1_label', true );
	$btn1_url   = get_post_meta( $post->ID, 'pre_footer_cta_btn1_url', true );
	$btn2_label = get_post_meta( $post->ID, 'pre_footer_cta_btn2_label', true );
	$btn2_url   = get_post_meta( $post->ID, 'pre_footer_cta_btn2_url', true );
	?>
	<p style="color:#666; margin-bottom:12px;">
		<?php esc_html_e( 'Leave fields blank to use the site-wide defaults set in Appearance → Customize → Pre-Footer CTA.', 'slumber-falls' ); ?>
	</p>
	<table class="form-table">
		<tr>
			<th><label for="pre_footer_cta_hide"><?php esc_html_e( 'Hide CTA', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="checkbox" id="pre_footer_cta_hide" name="pre_footer_cta_hide" value="1" <?php checked( $hide, '1' ); ?>>
				<label for="pre_footer_cta_hide"><?php esc_html_e( 'Hide the pre-footer CTA section on this page', 'slumber-falls' ); ?></label>
			</td>
		</tr>
		<tr>
			<th><label for="pre_footer_cta_heading"><?php esc_html_e( 'Heading', 'slumber-falls' ); ?></label></th>
			<td>
				<input type="text" id="pre_footer_cta_heading" name="pre_footer_cta_heading"
					value="<?php echo esc_attr( $heading ); ?>"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_heading', __( 'Ready to Join Us?', 'slumber-falls' ) ) ); ?>"
					class="large-text">
			</td>
		</tr>
		<tr>
			<th><label for="pre_footer_cta_subtext"><?php esc_html_e( 'Subtext', 'slumber-falls' ); ?></label></th>
			<td>
				<textarea id="pre_footer_cta_subtext" name="pre_footer_cta_subtext" rows="2" class="large-text"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_subtext', '' ) ); ?>"><?php echo esc_textarea( $subtext ); ?></textarea>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Button 1', 'slumber-falls' ); ?></th>
			<td>
				<input type="text" name="pre_footer_cta_btn1_label"
					value="<?php echo esc_attr( $btn1_label ); ?>"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_btn1_label', __( 'Explore Camps', 'slumber-falls' ) ) ); ?>"
					class="regular-text" style="margin-bottom:4px;">
				<br>
				<input type="url" name="pre_footer_cta_btn1_url"
					value="<?php echo esc_attr( $btn1_url ); ?>"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_btn1_url', '/camps/' ) ); ?>"
					class="large-text">
				<p class="description"><?php esc_html_e( 'Label then URL', 'slumber-falls' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Button 2', 'slumber-falls' ); ?></th>
			<td>
				<input type="text" name="pre_footer_cta_btn2_label"
					value="<?php echo esc_attr( $btn2_label ); ?>"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_btn2_label', __( 'Contact Us', 'slumber-falls' ) ) ); ?>"
					class="regular-text" style="margin-bottom:4px;">
				<br>
				<input type="url" name="pre_footer_cta_btn2_url"
					value="<?php echo esc_attr( $btn2_url ); ?>"
					placeholder="<?php echo esc_attr( get_theme_mod( 'pre_footer_cta_btn2_url', '/contact/' ) ); ?>"
					class="large-text">
				<p class="description"><?php esc_html_e( 'Label then URL (optional)', 'slumber-falls' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Pre-Footer CTA meta box data.
 *
 * @param int $post_id Post ID.
 */
function slumber_falls_save_pre_footer_cta( $post_id ) {
	if ( ! isset( $_POST['slumber_falls_pre_footer_cta_nonce_field'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['slumber_falls_pre_footer_cta_nonce_field'], 'slumber_falls_pre_footer_cta_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Hide checkbox.
	if ( isset( $_POST['pre_footer_cta_hide'] ) ) {
		update_post_meta( $post_id, 'pre_footer_cta_hide', '1' );
	} else {
		delete_post_meta( $post_id, 'pre_footer_cta_hide' );
	}

	$text_fields = array(
		'pre_footer_cta_heading',
		'pre_footer_cta_subtext',
		'pre_footer_cta_btn1_label',
		'pre_footer_cta_btn2_label',
	);
	foreach ( $text_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}

	$url_fields = array( 'pre_footer_cta_btn1_url', 'pre_footer_cta_btn2_url' );
	foreach ( $url_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
		}
	}
}
add_action( 'save_post', 'slumber_falls_save_pre_footer_cta' );
