<?php
/**
 * Form Handlers for Slumber Falls Theme
 *
 * @package Slumber_Falls
 */

/**
 * Process Contact Form Submission
 *
 * @return array Result array with 'success' boolean and 'message' string
 */
function slumber_falls_process_contact_form() {
	$result = array(
		'success' => false,
		'message' => '',
		'errors'  => array(),
	);

	// Check if form was submitted
	if ( ! isset( $_POST['contact_form_nonce'] ) ) {
		return $result;
	}

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['contact_form_nonce'], 'slumber_falls_contact_form' ) ) {
		$result['errors']['general'] = 'Security check failed. Please try again.';
		return $result;
	}

	// Check rate limiting (5-minute cooldown per IP)
	$ip_address     = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';
	$transient_key  = 'contact_form_' . md5( $ip_address );

	if ( get_transient( $transient_key ) ) {
		$result['errors']['general'] = 'Please wait 5 minutes before submitting again.';
		$result['message']           = 'Please wait 5 minutes before submitting another message.';
		return $result;
	}

	// Check honeypot field (should be empty)
	if ( ! empty( $_POST['website'] ) ) {
		// Spam detected - fail silently
		$result['message'] = 'Thank you for your message. We will respond within 24 hours.';
		$result['success'] = true;
		return $result; // Don't actually process or send email
	}

	// Get and sanitize form data
	$name     = isset( $_POST['contact_name'] ) ? sanitize_text_field( $_POST['contact_name'] ) : '';
	$email    = isset( $_POST['contact_email'] ) ? sanitize_email( $_POST['contact_email'] ) : '';
	$phone    = isset( $_POST['contact_phone'] ) ? sanitize_text_field( $_POST['contact_phone'] ) : '';
	$message  = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( $_POST['contact_message'] ) : '';
	$consent  = isset( $_POST['contact_consent'] ) ? true : false;

	// Server-side validation
	$has_errors = false;

	// Validate name
	if ( empty( $name ) ) {
		$result['errors']['name'] = 'Please enter your name';
		$has_errors               = true;
	}

	// Validate email
	if ( empty( $email ) ) {
		$result['errors']['email'] = 'Please enter your email address';
		$has_errors                = true;
	} elseif ( ! is_email( $email ) ) {
		$result['errors']['email'] = 'Please enter a valid email address';
		$has_errors                = true;
	}

	// Validate message
	if ( empty( $message ) ) {
		$result['errors']['message'] = 'Please enter your message';
		$has_errors                  = true;
	}

	// Validate consent
	if ( ! $consent ) {
		$result['errors']['consent'] = 'You must agree to the privacy policy';
		$has_errors                  = true;
	}

	// If validation failed, return errors
	if ( $has_errors ) {
		$result['message'] = 'Please correct the errors below and try again.';
		return $result;
	}

	// Prepare email
	$to      = get_option( 'admin_email' ); // Uses WordPress admin email
	$subject = 'New Contact Form Submission from ' . $name;

	// Email body
	$body  = "New contact form submission received:\n\n";
	$body .= "Name: " . $name . "\n";
	$body .= "Email: " . $email . "\n";
	$body .= "Phone: " . ( ! empty( $phone ) ? $phone : 'Not provided' ) . "\n\n";
	$body .= "Message:\n" . $message . "\n\n";
	$body .= "---\n";
	$body .= "Submitted: " . current_time( 'mysql' ) . "\n";
	$body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

	// Email headers
	$headers = array(
		'From: Slumber Falls Website <noreply@' . $_SERVER['HTTP_HOST'] . '>',
		'Reply-To: ' . $name . ' <' . $email . '>',
		'Content-Type: text/plain; charset=UTF-8',
	);

	// Send email
	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		$result['success'] = true;
		$result['message'] = 'Thank you! We\'ll respond within 24 hours.';

		// Set rate limit transient (5 minutes)
		set_transient( $transient_key, true, 5 * MINUTE_IN_SECONDS );
	} else {
		$result['errors']['general'] = 'There was an error sending your message. Please try again or contact us directly.';
		$result['message']           = 'There was an error sending your message. Please try again.';
	}

	return $result;
}

/**
 * Process Retreat Inquiry Form Submission
 *
 * @return array Result array with 'success' boolean and 'message' string
 */
function slumber_falls_process_retreat_inquiry_form() {
	$result = array(
		'success' => false,
		'message' => '',
		'errors'  => array(),
	);

	// Check if form was submitted
	if ( ! isset( $_POST['retreat_inquiry_nonce'] ) ) {
		return $result;
	}

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['retreat_inquiry_nonce'], 'slumber_falls_retreat_inquiry_form' ) ) {
		$result['errors']['general'] = 'Security check failed. Please try again.';
		return $result;
	}

	// Check rate limiting (5-minute cooldown per IP)
	$ip_address     = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';
	$transient_key  = 'retreat_form_' . md5( $ip_address );

	if ( get_transient( $transient_key ) ) {
		$result['errors']['general'] = 'Please wait 5 minutes before submitting again.';
		$result['message']           = 'Please wait 5 minutes before submitting another inquiry.';
		return $result;
	}

	// Check honeypot field (should be empty)
	if ( ! empty( $_POST['retreat_website'] ) ) {
		// Spam detected - fail silently
		$result['message'] = 'Thank you! We\'ll send you a custom quote within 48 hours.';
		$result['success'] = true;
		return $result; // Don't actually process or send email
	}

	// Get and sanitize form data
	$org_name       = isset( $_POST['retreat_org_name'] ) ? sanitize_text_field( $_POST['retreat_org_name'] ) : '';
	$contact_person = isset( $_POST['retreat_contact_person'] ) ? sanitize_text_field( $_POST['retreat_contact_person'] ) : '';
	$email          = isset( $_POST['retreat_email'] ) ? sanitize_email( $_POST['retreat_email'] ) : '';
	$phone          = isset( $_POST['retreat_phone'] ) ? sanitize_text_field( $_POST['retreat_phone'] ) : '';
	$arrival        = isset( $_POST['retreat_arrival'] ) ? sanitize_text_field( $_POST['retreat_arrival'] ) : '';
	$departure      = isset( $_POST['retreat_departure'] ) ? sanitize_text_field( $_POST['retreat_departure'] ) : '';
	$group_size     = isset( $_POST['retreat_group_size'] ) ? absint( $_POST['retreat_group_size'] ) : 0;
	$retreat_type   = isset( $_POST['retreat_type'] ) ? sanitize_text_field( $_POST['retreat_type'] ) : '';
	$requests       = isset( $_POST['retreat_requests'] ) ? sanitize_textarea_field( $_POST['retreat_requests'] ) : '';
	$consent        = isset( $_POST['retreat_consent'] ) ? true : false;

	// Server-side validation
	$has_errors = false;

	// Validate organization name
	if ( empty( $org_name ) ) {
		$result['errors']['org_name'] = 'Please enter your organization name';
		$has_errors                   = true;
	}

	// Validate contact person
	if ( empty( $contact_person ) ) {
		$result['errors']['contact_person'] = 'Please enter your name';
		$has_errors                         = true;
	}

	// Validate email
	if ( empty( $email ) ) {
		$result['errors']['email'] = 'Please enter your email address';
		$has_errors                = true;
	} elseif ( ! is_email( $email ) ) {
		$result['errors']['email'] = 'Please enter a valid email address';
		$has_errors                = true;
	}

	// Validate phone
	if ( empty( $phone ) ) {
		$result['errors']['phone'] = 'Please enter your phone number';
		$has_errors                = true;
	}

	// Validate group size
	if ( $group_size < 1 ) {
		$result['errors']['group_size'] = 'Please enter your group size';
		$has_errors                     = true;
	}

	// Validate retreat type
	if ( empty( $retreat_type ) ) {
		$result['errors']['retreat_type'] = 'Please select a retreat type';
		$has_errors                       = true;
	}

	// Validate consent
	if ( ! $consent ) {
		$result['errors']['consent'] = 'You must agree to the privacy policy';
		$has_errors                  = true;
	}

	// If validation failed, return errors
	if ( $has_errors ) {
		$result['message'] = 'Please correct the errors below and try again.';
		return $result;
	}

	// Prepare email
	$to      = get_option( 'admin_email' ); // Uses WordPress admin email
	$subject = 'New Retreat Inquiry from ' . $org_name;

	// Email body
	$body  = "New retreat inquiry received:\n\n";
	$body .= "Organization: " . $org_name . "\n";
	$body .= "Contact Person: " . $contact_person . "\n";
	$body .= "Email: " . $email . "\n";
	$body .= "Phone: " . $phone . "\n\n";
	$body .= "Retreat Details:\n";
	$body .= "Preferred Arrival: " . ( ! empty( $arrival ) ? $arrival : 'Not specified' ) . "\n";
	$body .= "Preferred Departure: " . ( ! empty( $departure ) ? $departure : 'Not specified' ) . "\n";
	$body .= "Group Size: " . $group_size . " people\n";
	$body .= "Retreat Type: " . $retreat_type . "\n\n";

	if ( ! empty( $requests ) ) {
		$body .= "Special Requests:\n" . $requests . "\n\n";
	}

	$body .= "---\n";
	$body .= "Submitted: " . current_time( 'mysql' ) . "\n";
	$body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

	// Email headers
	$headers = array(
		'From: Slumber Falls Website <noreply@' . $_SERVER['HTTP_HOST'] . '>',
		'Reply-To: ' . $contact_person . ' <' . $email . '>',
		'Content-Type: text/plain; charset=UTF-8',
	);

	// Send email
	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		$result['success'] = true;
		$result['message'] = 'Thank you! We\'ll send you a custom quote within 48 hours.';

		// Set rate limit transient (5 minutes)
		set_transient( $transient_key, true, 5 * MINUTE_IN_SECONDS );

		// Fire Google Analytics event (if GA4 is integrated)
		// Note: This would be handled client-side via JavaScript in production
		// For now, we just note it in the result for potential JS handling
		$result['analytics_event'] = 'retreat_inquiry_submitted';
	} else {
		$result['errors']['general'] = 'There was an error sending your inquiry. Please try again or contact us directly.';
		$result['message']           = 'There was an error sending your inquiry. Please try again.';
	}

	return $result;
}

/**
 * Get form submission result from session/transient
 * This allows us to show messages after redirect
 */
function slumber_falls_get_form_result() {
	// Check for transient (used after processing)
	$result = get_transient( 'contact_form_result_' . get_current_user_id() );

	if ( $result ) {
		// Delete transient so it only shows once
		delete_transient( 'contact_form_result_' . get_current_user_id() );
		return $result;
	}

	return null;
}

/**
 * Set form submission result in transient
 */
function slumber_falls_set_form_result( $result ) {
	set_transient( 'contact_form_result_' . get_current_user_id(), $result, 60 ); // 60 seconds
}
