<?php
/**
 * Template Name: Contact Page
 *
 * The template for displaying the Contact page with form
 *
 * @package Slumber_Falls
 */

// Process form submission if POST request
$form_result      = null;
$form_data        = array();
$show_form        = true;

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['contact_form_nonce'] ) ) {
	$form_result = slumber_falls_process_contact_form();

	// If successful, don't pre-fill form (clear it)
	if ( $form_result['success'] ) {
		$form_data  = array(); // Clear form
		$show_form  = true; // Keep showing form with success message
	} else {
		// If errors, pre-fill form with submitted data
		$form_data = array(
			'name'    => isset( $_POST['contact_name'] ) ? sanitize_text_field( $_POST['contact_name'] ) : '',
			'email'   => isset( $_POST['contact_email'] ) ? sanitize_email( $_POST['contact_email'] ) : '',
			'phone'   => isset( $_POST['contact_phone'] ) ? sanitize_text_field( $_POST['contact_phone'] ) : '',
			'message' => isset( $_POST['contact_message'] ) ? sanitize_textarea_field( $_POST['contact_message'] ) : '',
			'consent' => isset( $_POST['contact_consent'] ),
		);
	}
}

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- Breadcrumb Navigation -->
		<nav class="breadcrumb-nav py-4 px-4 max-w-7xl mx-auto" aria-label="Breadcrumb">
			<ol class="flex items-center space-x-2 text-sm text-gray-600">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-blue">Home</a></li>
				<li><span class="mx-2">&gt;</span></li>
				<li class="text-gray-900" aria-current="page">Contact</li>
			</ol>
		</nav>

		<div class="contact-page py-12 px-4">
			<div class="max-w-4xl mx-auto">

				<!-- Page Header -->
				<div class="text-center mb-12">
					<h1 class="text-4xl md:text-5xl font-bold mb-4 text-brand-blue">
						<?php the_title(); ?>
					</h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="text-xl text-gray-700">
							<?php echo esc_html( get_the_excerpt() ); ?>
						</p>
					<?php else : ?>
						<p class="text-xl text-gray-700">
							Have questions? We're here to help. Send us a message and we'll respond within 24 hours.
						</p>
					<?php endif; ?>
				</div>

				<!-- Form Messages -->
				<?php if ( $form_result ) : ?>
					<?php if ( $form_result['success'] ) : ?>
						<!-- Success Message -->
						<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded" role="status">
							<div class="flex items-center">
								<svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
								</svg>
								<p class="text-green-700 font-semibold"><?php echo esc_html( $form_result['message'] ); ?></p>
							</div>
						</div>
					<?php else : ?>
						<!-- Error Message -->
						<div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded" role="alert">
							<div class="flex items-start">
								<svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
								</svg>
								<div>
									<p class="text-red-700 font-semibold mb-2"><?php echo esc_html( $form_result['message'] ); ?></p>
									<?php if ( ! empty( $form_result['errors']['general'] ) ) : ?>
										<p class="text-red-600 text-sm"><?php echo esc_html( $form_result['errors']['general'] ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Two Column Layout: Contact Info + Form -->
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

					<!-- Contact Information Column -->
					<div class="contact-info">
						<h2 class="text-2xl font-bold mb-6 text-brand-blue">Get In Touch</h2>

						<!-- Address -->
						<div class="mb-6" itemscope itemtype="https://schema.org/LocalBusiness">
							<meta itemprop="name" content="Slumber Falls Camp & Retreat Center">
							<h3 class="text-lg font-semibold mb-2 text-gray-900 flex items-center">
								<svg class="w-5 h-5 mr-2 text-brand-blue" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
								</svg>
								Address
							</h3>
							<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" class="text-gray-700">
								<span itemprop="streetAddress">1234 Camp Road</span><br>
								<span itemprop="addressLocality">New Braunfels</span>,
								<span itemprop="addressRegion">TX</span>
								<span itemprop="postalCode">78130</span>
							</div>
						</div>

						<!-- Phone -->
						<div class="mb-6">
							<h3 class="text-lg font-semibold mb-2 text-gray-900 flex items-center">
								<svg class="w-5 h-5 mr-2 text-brand-blue" fill="currentColor" viewBox="0 0 20 20">
									<path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
								</svg>
								Phone
							</h3>
							<a href="tel:+18305551234" class="text-brand-blue hover:text-brand-blue-600 text-lg font-medium">
								(830) 555-1234
							</a>
						</div>

						<!-- Email -->
						<div class="mb-6">
							<h3 class="text-lg font-semibold mb-2 text-gray-900 flex items-center">
								<svg class="w-5 h-5 mr-2 text-brand-blue" fill="currentColor" viewBox="0 0 20 20">
									<path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
									<path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
								</svg>
								Email
							</h3>
							<a href="mailto:info&#64;slumberfalls&#46;org" class="text-brand-blue hover:text-brand-blue-600 text-lg font-medium break-words">
								info<span style="display:none">-remove-</span>&#64;slumberfalls&#46;org
							</a>
						</div>

						<!-- Office Hours -->
						<div class="mb-8">
							<h3 class="text-lg font-semibold mb-2 text-gray-900 flex items-center">
								<svg class="w-5 h-5 mr-2 text-brand-blue" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
								</svg>
								Office Hours
							</h3>
							<p class="text-gray-700">
								Monday - Friday: 9:00 AM - 5:00 PM<br>
								Saturday - Sunday: Closed
							</p>
						</div>

						<!-- Google Maps -->
						<div class="map-container mb-6">
							<h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
								<svg class="w-5 h-5 mr-2 text-brand-blue" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"/>
								</svg>
								Directions
							</h3>
							<div class="rounded-lg overflow-hidden shadow-md">
								<iframe
									src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55179.17342111728!2d-98.15833342089843!3d29.703155100000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865cbd4359ce8ed9%3A0xf1b3b4fc465a9d3!2sNew%20Braunfels%2C%20TX!5e0!3m2!1sen!2sus!4v1234567890123"
									width="100%"
									height="300"
									style="border:0;"
									allowfullscreen=""
									loading="lazy"
									referrerpolicy="no-referrer-when-downgrade"
									title="Slumber Falls Camp Location Map"
								></iframe>
							</div>
						</div>
					</div>

					<!-- Contact Form Column -->
					<div class="contact-form-column">
				<div class="bg-white rounded-lg shadow-md p-8">
					<form id="contact-form" class="contact-form" method="post" action="" novalidate>

						<!-- WordPress Nonce for Security -->
						<?php wp_nonce_field( 'slumber_falls_contact_form', 'contact_form_nonce' ); ?>

						<!-- Honeypot Field (Hidden from users, catches bots) -->
						<div class="hidden" aria-hidden="true">
							<label for="website">Website</label>
							<input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
						</div>

						<!-- Name Field (Required) -->
						<div class="mb-6">
							<label for="contact-name" class="block text-gray-700 font-semibold mb-2">
								Name <span class="text-red-500">*</span>
							</label>
							<input
								type="text"
								id="contact-name"
								name="contact_name"
								required
								aria-required="true"
								aria-describedby="name-error"
								value="<?php echo isset( $form_data['name'] ) ? esc_attr( $form_data['name'] ) : ''; ?>"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $form_result['errors']['name'] ) ) ? 'border-red-500' : ''; ?>"
								placeholder="Your full name"
							>
							<div id="name-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $form_result['errors']['name'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('contact-name').focus()">
								<?php echo ! empty( $form_result['errors']['name'] ) ? esc_html( $form_result['errors']['name'] ) : ''; ?>
							</div>
						</div>

						<!-- Email Field (Required) -->
						<div class="mb-6">
							<label for="contact-email" class="block text-gray-700 font-semibold mb-2">
								Email <span class="text-red-500">*</span>
							</label>
							<input
								type="email"
								id="contact-email"
								name="contact_email"
								required
								aria-required="true"
								aria-describedby="email-error"
								value="<?php echo isset( $form_data['email'] ) ? esc_attr( $form_data['email'] ) : ''; ?>"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $form_result['errors']['email'] ) ) ? 'border-red-500' : ''; ?>"
								placeholder="your.email@example.com"
							>
							<div id="email-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $form_result['errors']['email'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('contact-email').focus()">
								<?php echo ! empty( $form_result['errors']['email'] ) ? esc_html( $form_result['errors']['email'] ) : ''; ?>
							</div>
						</div>

						<!-- Phone Field (Optional) -->
						<div class="mb-6">
							<label for="contact-phone" class="block text-gray-700 font-semibold mb-2">
								Phone
							</label>
							<input
								type="tel"
								id="contact-phone"
								name="contact_phone"
								aria-describedby="phone-error"
								value="<?php echo isset( $form_data['phone'] ) ? esc_attr( $form_data['phone'] ) : ''; ?>"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors"
								placeholder="(555) 123-4567"
							>
							<div id="phone-error" class="text-red-600 text-sm mt-1 hidden cursor-pointer hover:underline" role="alert" onclick="document.getElementById('contact-phone').focus()"></div>
						</div>

						<!-- Message Field (Required) -->
						<div class="mb-6">
							<label for="contact-message" class="block text-gray-700 font-semibold mb-2">
								Message <span class="text-red-500">*</span>
							</label>
							<textarea
								id="contact-message"
								name="contact_message"
								required
								aria-required="true"
								aria-describedby="message-error"
								rows="6"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors resize-y <?php echo ( ! empty( $form_result['errors']['message'] ) ) ? 'border-red-500' : ''; ?>"
								placeholder="How can we help you?"
							><?php echo isset( $form_data['message'] ) ? esc_textarea( $form_data['message'] ) : ''; ?></textarea>
							<div id="message-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $form_result['errors']['message'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('contact-message').focus()">
								<?php echo ! empty( $form_result['errors']['message'] ) ? esc_html( $form_result['errors']['message'] ) : ''; ?>
							</div>
						</div>

						<!-- Privacy Consent (Required) -->
						<div class="mb-8">
							<label class="flex items-start">
								<input
									type="checkbox"
									id="contact-consent"
									name="contact_consent"
									required
									aria-required="true"
									aria-describedby="consent-error"
									<?php echo ( isset( $form_data['consent'] ) && $form_data['consent'] ) ? 'checked' : ''; ?>
									class="mt-1 h-5 w-5 text-brand-blue border-gray-300 rounded focus:ring-2 focus:ring-brand-blue"
								>
								<span class="ml-3 text-gray-700">
									I agree to the
									<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"
									   class="text-brand-blue hover:text-brand-blue-600 underline"
									   target="_blank">
										privacy policy
									</a>
									<span class="text-red-500">*</span>
								</span>
							</label>
							<div id="consent-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $form_result['errors']['consent'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('contact-consent').focus()">
								<?php echo ! empty( $form_result['errors']['consent'] ) ? esc_html( $form_result['errors']['consent'] ) : ''; ?>
							</div>
						</div>

						<!-- Submit Button -->
						<div class="text-center">
							<button
								type="submit"
								id="contact-submit"
								class="bg-brand-blue hover:bg-brand-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-all duration-200 min-w-[200px] disabled:opacity-50 disabled:cursor-not-allowed"
							>
								<span class="submit-text">Send Message</span>
								<span class="submit-loading hidden">
									<svg class="animate-spin inline-block h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
										<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
										<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
									</svg>
									Sending...
								</span>
							</button>
						</div>

						<!-- Form Status Messages -->
						<div id="form-messages" class="mt-6 hidden"></div>

					</form>
				</div><!-- .bg-white -->
					</div><!-- .contact-form-column -->

				</div><!-- .grid two-column layout -->

				<!-- Page Content (if any) -->
				<?php if ( get_the_content() ) : ?>
					<div class="page-content mt-12 prose prose-lg max-w-none">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>

	<?php endwhile; ?>

</main>

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array(
	'wave_from'                  => 'white',
	'pre_footer_cta_btn1_label'  => __( 'View Summer Camps', 'slumber-falls' ),
	'pre_footer_cta_btn1_url'    => home_url( '/camps/' ),
	'pre_footer_cta_btn2_label'  => __( 'Plan a Retreat', 'slumber-falls' ),
	'pre_footer_cta_btn2_url'    => home_url( '/retreats/' ),
) ); ?>

<script>
/**
 * Contact Form Client-Side Validation
 */
(function() {
	'use strict';

	const form = document.getElementById('contact-form');
	const submitBtn = document.getElementById('contact-submit');
	const submitText = submitBtn.querySelector('.submit-text');
	const submitLoading = submitBtn.querySelector('.submit-loading');

	// Field elements
	const fields = {
		name: document.getElementById('contact-name'),
		email: document.getElementById('contact-email'),
		phone: document.getElementById('contact-phone'),
		message: document.getElementById('contact-message'),
		consent: document.getElementById('contact-consent')
	};

	// Error message elements
	const errors = {
		name: document.getElementById('name-error'),
		email: document.getElementById('email-error'),
		phone: document.getElementById('phone-error'),
		message: document.getElementById('message-error'),
		consent: document.getElementById('consent-error')
	};

	/**
	 * Validate email format
	 */
	function isValidEmail(email) {
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
	}

	/**
	 * Show error message for a field
	 */
	function showError(fieldName, message) {
		const errorElement = errors[fieldName];
		if (errorElement) {
			errorElement.textContent = message;
			errorElement.classList.remove('hidden');
			fields[fieldName].classList.add('border-red-500');
			fields[fieldName].setAttribute('aria-invalid', 'true');
		}
	}

	/**
	 * Clear error message for a field
	 */
	function clearError(fieldName) {
		const errorElement = errors[fieldName];
		if (errorElement) {
			errorElement.textContent = '';
			errorElement.classList.add('hidden');
			fields[fieldName].classList.remove('border-red-500');
			fields[fieldName].removeAttribute('aria-invalid');
		}
	}

	/**
	 * Clear all errors
	 */
	function clearAllErrors() {
		Object.keys(errors).forEach(clearError);
	}

	/**
	 * Validate individual field
	 */
	function validateField(fieldName) {
		const field = fields[fieldName];
		let isValid = true;

		clearError(fieldName);

		switch(fieldName) {
			case 'name':
				if (!field.value.trim()) {
					showError('name', 'Please enter your name');
					isValid = false;
				}
				break;

			case 'email':
				if (!field.value.trim()) {
					showError('email', 'Please enter your email address');
					isValid = false;
				} else if (!isValidEmail(field.value.trim())) {
					showError('email', 'Please enter a valid email address');
					isValid = false;
				}
				break;

			case 'message':
				if (!field.value.trim()) {
					showError('message', 'Please enter your message');
					isValid = false;
				}
				break;

			case 'consent':
				if (!field.checked) {
					showError('consent', 'You must agree to the privacy policy');
					isValid = false;
				}
				break;
		}

		return isValid;
	}

	/**
	 * Validate entire form
	 */
	function validateForm() {
		clearAllErrors();
		let isValid = true;

		// Validate required fields
		['name', 'email', 'message', 'consent'].forEach(function(fieldName) {
			if (!validateField(fieldName)) {
				isValid = false;
			}
		});

		return isValid;
	}

	/**
	 * Show loading state
	 */
	function showLoadingState() {
		submitBtn.disabled = true;
		submitText.classList.add('hidden');
		submitLoading.classList.remove('hidden');
	}

	/**
	 * Hide loading state
	 */
	function hideLoadingState() {
		submitBtn.disabled = false;
		submitText.classList.remove('hidden');
		submitLoading.classList.add('hidden');
	}

	/**
	 * Handle form submission
	 */
	function handleSubmit(e) {
		// Validate form
		if (!validateForm()) {
			e.preventDefault();

			// Focus on first error field
			const firstErrorField = form.querySelector('[aria-invalid="true"]');
			if (firstErrorField) {
				firstErrorField.focus();
			}
			return false;
		}

		// Show loading state
		showLoadingState();

		// Let form submit naturally to server
		// PHP will process and return with success/error messages
		return true;
	}

	// Event listeners
	if (form) {
		form.addEventListener('submit', handleSubmit);

		// Real-time validation on blur
		Object.keys(fields).forEach(function(fieldName) {
			if (fields[fieldName]) {
				fields[fieldName].addEventListener('blur', function() {
					if (this.value || fieldName === 'consent') {
						validateField(fieldName);
					}
				});

				// Clear error on input
				fields[fieldName].addEventListener('input', function() {
					if (errors[fieldName] && !errors[fieldName].classList.contains('hidden')) {
						clearError(fieldName);
					}
				});
			}
		});
	}

})();
</script>

<?php
get_footer();
