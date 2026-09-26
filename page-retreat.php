<?php
/**
 * Template Name: Retreat Page
 *
 * The template for displaying the Retreat information page
 *
 * @package Slumber_Falls
 */

// Process retreat inquiry form submission if POST request
$retreat_form_result = null;
$retreat_form_data   = array();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['retreat_inquiry_nonce'] ) ) {
	$retreat_form_result = slumber_falls_process_retreat_inquiry_form();

	// If successful, don't pre-fill form (clear it)
	if ( $retreat_form_result['success'] ) {
		$retreat_form_data = array(); // Clear form
	} else {
		// If errors, pre-fill form with submitted data
		$retreat_form_data = array(
			'org_name'       => isset( $_POST['retreat_org_name'] ) ? sanitize_text_field( $_POST['retreat_org_name'] ) : '',
			'contact_person' => isset( $_POST['retreat_contact_person'] ) ? sanitize_text_field( $_POST['retreat_contact_person'] ) : '',
			'email'          => isset( $_POST['retreat_email'] ) ? sanitize_email( $_POST['retreat_email'] ) : '',
			'phone'          => isset( $_POST['retreat_phone'] ) ? sanitize_text_field( $_POST['retreat_phone'] ) : '',
			'arrival'        => isset( $_POST['retreat_arrival'] ) ? sanitize_text_field( $_POST['retreat_arrival'] ) : '',
			'departure'      => isset( $_POST['retreat_departure'] ) ? sanitize_text_field( $_POST['retreat_departure'] ) : '',
			'group_size'     => isset( $_POST['retreat_group_size'] ) ? absint( $_POST['retreat_group_size'] ) : '',
			'retreat_type'   => isset( $_POST['retreat_type'] ) ? sanitize_text_field( $_POST['retreat_type'] ) : '',
			'requests'       => isset( $_POST['retreat_requests'] ) ? sanitize_textarea_field( $_POST['retreat_requests'] ) : '',
			'consent'        => isset( $_POST['retreat_consent'] ),
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
				<li class="text-gray-900" aria-current="page">Retreats</li>
			</ol>
		</nav>

		<!-- Hero Section -->
		<section class="retreat-hero relative bg-brand-blue text-white py-20 px-4">
			<div class="max-w-7xl mx-auto text-center">
				<h1 class="text-4xl md:text-5xl font-bold mb-4">Host Your Retreat at Slumber Falls</h1>
				<p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
					A peaceful, faith-based setting for your church, youth group, or ministry retreat
				</p>
				<a href="#retreat-inquiry-form"
				   class="inline-block bg-brand-yellow hover:bg-brand-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-lg transition-colors duration-200 smooth-scroll">
					Request a Quote
				</a>
			</div>
		</section>

		<!-- Retreat Types Section -->
		<section class="retreat-types py-16 px-4 bg-gray-50">
			<div class="max-w-7xl mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-brand-blue">Find Your Retreat Experience</h2>

				<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
					<!-- Overnight Retreats -->
					<div class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-shadow duration-200">
						<div class="text-4xl mb-4 text-brand-blue">🌙</div>
						<h3 class="text-2xl font-bold mb-4 text-gray-900">Overnight Retreats</h3>
						<p class="text-gray-700 mb-4">
							Multi-day immersive experiences with comfortable lodging, meals, and full access to our facilities and grounds.
						</p>
					</div>

					<!-- Day Retreats -->
					<div class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-shadow duration-200">
						<div class="text-4xl mb-4 text-brand-yellow">☀️</div>
						<h3 class="text-2xl font-bold mb-4 text-gray-900">Day Retreats</h3>
						<p class="text-gray-700 mb-4">
							Single-day programs perfect for team building, spiritual renewal, or ministry planning sessions.
						</p>
					</div>

					<!-- Custom Group Events -->
					<div class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-shadow duration-200">
						<div class="text-4xl mb-4 text-brand-green">👥</div>
						<h3 class="text-2xl font-bold mb-4 text-gray-900">Custom Group Events</h3>
						<p class="text-gray-700 mb-4">
							Tailored experiences for conferences, family camps, women's ministry, youth groups, and special occasions.
						</p>
					</div>
				</div>
			</div>
		</section>

		<!-- Why Choose Slumber Falls Section -->
		<section class="why-choose py-16 px-4">
			<div class="max-w-7xl mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-brand-blue">Why Choose Slumber Falls</h2>

				<div class="max-w-4xl mx-auto">
					<ul class="space-y-6 text-lg">
						<li class="flex items-start">
							<svg class="w-6 h-6 text-brand-green mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
							</svg>
							<div>
								<strong class="text-brand-blue">68+ Year Legacy:</strong>
								<span class="text-gray-700"> Since 1956, we've been serving churches and ministries with excellence and faith-based hospitality.</span>
							</div>
						</li>
						<li class="flex items-start">
							<svg class="w-6 h-6 text-brand-green mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
							</svg>
							<div>
								<strong class="text-brand-blue">Faith-Based Environment:</strong>
								<span class="text-gray-700"> Christ-centered atmosphere designed to encourage spiritual growth and meaningful connections.</span>
							</div>
						</li>
						<li class="flex items-start">
							<svg class="w-6 h-6 text-brand-green mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
							</svg>
							<div>
								<strong class="text-brand-blue">Natural Setting:</strong>
								<span class="text-gray-700"> Beautiful Texas Hill Country location provides a peaceful backdrop for reflection and renewal.</span>
							</div>
						</li>
						<li class="flex items-start">
							<svg class="w-6 h-6 text-brand-green mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
							</svg>
							<div>
								<strong class="text-brand-blue">Flexible Programming:</strong>
								<span class="text-gray-700"> Bring your own speakers and schedule, or let our experienced team help design your program.</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<!-- Facilities Overview Section -->
		<section class="facilities-overview py-16 px-4 bg-gray-50">
			<div class="max-w-7xl mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-brand-blue">Our Retreat Facilities</h2>
				<p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
					Modern amenities in a natural setting, perfect for groups of all sizes
				</p>

				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					// Query facilities available for retreats
					$facilities_query = new WP_Query(
						array(
							'post_type'      => 'facility',
							'posts_per_page' => -1,
							'meta_query'     => array(
								array(
									'key'     => 'facility_available_retreats',
									'value'   => '1',
									'compare' => '=',
								),
							),
							'orderby'        => 'menu_order title',
							'order'          => 'ASC',
						)
					);

					if ( $facilities_query->have_posts() ) :
						while ( $facilities_query->have_posts() ) :
							$facilities_query->the_post();
							$capacity  = get_post_meta( get_the_ID(), 'facility_capacity', true );
							$amenities = get_post_meta( get_the_ID(), 'facility_amenities', true );
							?>
							<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="aspect-w-16 aspect-h-9 bg-gray-200">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
									</div>
								<?php endif; ?>

								<div class="p-6">
									<h3 class="text-xl font-bold mb-2 text-gray-900">
										<a href="<?php the_permalink(); ?>" class="hover:text-brand-blue transition-colors">
											<?php the_title(); ?>
										</a>
									</h3>

									<?php if ( $capacity ) : ?>
										<p class="text-brand-blue font-semibold mb-2">
											Capacity: <?php echo esc_html( $capacity ); ?>
										</p>
									<?php endif; ?>

									<?php if ( has_excerpt() ) : ?>
										<p class="text-gray-700 text-sm mb-3"><?php echo esc_html( get_the_excerpt() ); ?></p>
									<?php endif; ?>

									<a href="<?php the_permalink(); ?>"
									   class="inline-block text-brand-blue hover:text-brand-blue-600 font-semibold text-sm">
										View Details →
									</a>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						?>
						<div class="col-span-full text-center py-8">
							<p class="text-gray-600">Facility information coming soon. Contact us to learn about our retreat spaces.</p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- Pricing Information Section -->
		<section class="pricing py-16 px-4">
			<div class="max-w-4xl mx-auto text-center">
				<h2 class="text-3xl md:text-4xl font-bold mb-6 text-brand-blue">Custom Retreat Pricing</h2>
				<div class="bg-brand-blue-50 border-l-4 border-brand-blue p-6 rounded-lg">
					<p class="text-lg text-gray-800 mb-4">
						Every retreat is unique, and we believe your pricing should reflect your specific needs.
					</p>
					<p class="text-gray-700 mb-6">
						Pricing varies based on group size, duration, meal plans, and facility usage.
						Request a custom quote below, and we'll work with you to create a package that fits your budget and ministry goals.
					</p>
					<a href="#retreat-inquiry-form"
					   class="inline-block bg-brand-blue hover:bg-brand-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 smooth-scroll">
						Get Your Custom Quote
					</a>
				</div>
			</div>
		</section>

		<!-- Call-to-Action Section -->
		<section id="retreat-inquiry-form" class="cta-section py-16 px-4 bg-gray-50">
			<div class="max-w-4xl mx-auto">
				<div class="text-center mb-12">
					<h2 class="text-3xl md:text-4xl font-bold mb-4 text-brand-blue">Ready to Plan Your Retreat?</h2>
					<p class="text-xl text-gray-700">
						Fill out the form below and we'll send you a custom quote within 48 hours
					</p>
				</div>

				<!-- Form Messages -->
				<?php if ( $retreat_form_result ) : ?>
					<?php if ( $retreat_form_result['success'] ) : ?>
						<!-- Success Message -->
						<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded" role="status">
							<div class="flex items-center">
								<svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
								</svg>
								<p class="text-green-700 font-semibold"><?php echo esc_html( $retreat_form_result['message'] ); ?></p>
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
									<p class="text-red-700 font-semibold mb-2"><?php echo esc_html( $retreat_form_result['message'] ); ?></p>
									<?php if ( ! empty( $retreat_form_result['errors']['general'] ) ) : ?>
										<p class="text-red-600 text-sm"><?php echo esc_html( $retreat_form_result['errors']['general'] ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Retreat Inquiry Form -->
				<div class="bg-white rounded-lg shadow-md p-8">
					<form id="retreat-inquiry-form" class="retreat-inquiry-form" method="post" action="" novalidate>

						<!-- WordPress Nonce for Security -->
						<?php wp_nonce_field( 'slumber_falls_retreat_inquiry_form', 'retreat_inquiry_nonce' ); ?>

						<!-- Honeypot Field (Hidden from users, catches bots) -->
						<div class="hidden" aria-hidden="true">
							<label for="retreat-website">Website</label>
							<input type="text" id="retreat-website" name="retreat_website" tabindex="-1" autocomplete="off">
						</div>

						<!-- Organization Name Field (Required) -->
						<div class="mb-6">
							<label for="retreat-org-name" class="block text-gray-700 font-semibold mb-2">
								Organization Name <span class="text-red-500">*</span>
							</label>
							<input
								type="text"
								id="retreat-org-name"
								name="retreat_org_name"
								required
								aria-required="true"
								aria-describedby="org-name-error"
								value="<?php echo isset( $retreat_form_data['org_name'] ) ? esc_attr( $retreat_form_data['org_name'] ) : ''; ?>"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $retreat_form_result['errors']['org_name'] ) ) ? 'border-red-500' : ''; ?>"
								placeholder="Grace Community Church"
							>
							<div id="org-name-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['org_name'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-org-name').focus()">
								<?php echo ! empty( $retreat_form_result['errors']['org_name'] ) ? esc_html( $retreat_form_result['errors']['org_name'] ) : ''; ?>
							</div>
						</div>

						<!-- Contact Person Field (Required) -->
						<div class="mb-6">
							<label for="retreat-contact-person" class="block text-gray-700 font-semibold mb-2">
								Contact Person <span class="text-red-500">*</span>
							</label>
							<input
								type="text"
								id="retreat-contact-person"
								name="retreat_contact_person"
								required
								aria-required="true"
								aria-describedby="contact-person-error"
								value="<?php echo isset( $retreat_form_data['contact_person'] ) ? esc_attr( $retreat_form_data['contact_person'] ) : ''; ?>"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $retreat_form_result['errors']['contact_person'] ) ) ? 'border-red-500' : ''; ?>"
								placeholder="Your full name"
							>
							<div id="contact-person-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['contact_person'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-contact-person').focus()">
								<?php echo ! empty( $retreat_form_result['errors']['contact_person'] ) ? esc_html( $retreat_form_result['errors']['contact_person'] ) : ''; ?>
							</div>
						</div>

						<!-- Email and Phone - Two Column Layout on Desktop -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
							<!-- Email Field (Required) -->
							<div>
								<label for="retreat-email" class="block text-gray-700 font-semibold mb-2">
									Email <span class="text-red-500">*</span>
								</label>
								<input
									type="email"
									id="retreat-email"
									name="retreat_email"
									required
									aria-required="true"
									aria-describedby="retreat-email-error"
									value="<?php echo isset( $retreat_form_data['email'] ) ? esc_attr( $retreat_form_data['email'] ) : ''; ?>"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $retreat_form_result['errors']['email'] ) ) ? 'border-red-500' : ''; ?>"
									placeholder="your.email@example.com"
								>
								<div id="retreat-email-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['email'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-email').focus()">
									<?php echo ! empty( $retreat_form_result['errors']['email'] ) ? esc_html( $retreat_form_result['errors']['email'] ) : ''; ?>
								</div>
							</div>

							<!-- Phone Field (Required) -->
							<div>
								<label for="retreat-phone" class="block text-gray-700 font-semibold mb-2">
									Phone <span class="text-red-500">*</span>
								</label>
								<input
									type="tel"
									id="retreat-phone"
									name="retreat_phone"
									required
									aria-required="true"
									aria-describedby="retreat-phone-error"
									value="<?php echo isset( $retreat_form_data['phone'] ) ? esc_attr( $retreat_form_data['phone'] ) : ''; ?>"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $retreat_form_result['errors']['phone'] ) ) ? 'border-red-500' : ''; ?>"
									placeholder="(555) 123-4567"
								>
								<div id="retreat-phone-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['phone'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-phone').focus()">
									<?php echo ! empty( $retreat_form_result['errors']['phone'] ) ? esc_html( $retreat_form_result['errors']['phone'] ) : ''; ?>
								</div>
							</div>
						</div>

						<!-- Preferred Dates - Two Column Layout -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
							<!-- Arrival Date (Optional) -->
							<div>
								<label for="retreat-arrival" class="block text-gray-700 font-semibold mb-2">
									Preferred Arrival Date
								</label>
								<input
									type="date"
									id="retreat-arrival"
									name="retreat_arrival"
									aria-describedby="arrival-error"
									value="<?php echo isset( $retreat_form_data['arrival'] ) ? esc_attr( $retreat_form_data['arrival'] ) : ''; ?>"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors"
								>
								<div id="arrival-error" class="text-red-600 text-sm mt-1 hidden cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-arrival').focus()"></div>
							</div>

							<!-- Departure Date (Optional) -->
							<div>
								<label for="retreat-departure" class="block text-gray-700 font-semibold mb-2">
									Preferred Departure Date
								</label>
								<input
									type="date"
									id="retreat-departure"
									name="retreat_departure"
									aria-describedby="departure-error"
									value="<?php echo isset( $retreat_form_data['departure'] ) ? esc_attr( $retreat_form_data['departure'] ) : ''; ?>"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors"
								>
								<div id="departure-error" class="text-red-600 text-sm mt-1 hidden cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-departure').focus()"></div>
							</div>
						</div>

						<!-- Group Size and Retreat Type - Two Column Layout -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
							<!-- Group Size Field (Required) -->
							<div>
								<label for="retreat-group-size" class="block text-gray-700 font-semibold mb-2">
									Group Size <span class="text-red-500">*</span>
								</label>
								<input
									type="number"
									id="retreat-group-size"
									name="retreat_group_size"
									required
									aria-required="true"
									aria-describedby="group-size-error"
									min="1"
									value="<?php echo isset( $retreat_form_data['group_size'] ) ? esc_attr( $retreat_form_data['group_size'] ) : ''; ?>"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors <?php echo ( ! empty( $retreat_form_result['errors']['group_size'] ) ) ? 'border-red-500' : ''; ?>"
									placeholder="50 people"
								>
								<div id="group-size-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['group_size'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-group-size').focus()">
									<?php echo ! empty( $retreat_form_result['errors']['group_size'] ) ? esc_html( $retreat_form_result['errors']['group_size'] ) : ''; ?>
								</div>
							</div>

							<!-- Retreat Type Dropdown (Required) -->
							<div>
								<label for="retreat-type" class="block text-gray-700 font-semibold mb-2">
									Retreat Type <span class="text-red-500">*</span>
								</label>
								<select
									id="retreat-type"
									name="retreat_type"
									required
									aria-required="true"
									aria-describedby="retreat-type-error"
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors bg-white <?php echo ( ! empty( $retreat_form_result['errors']['retreat_type'] ) ) ? 'border-red-500' : ''; ?>"
								>
									<option value="">Select a retreat type...</option>
									<option value="Church Retreat" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Church Retreat' ) ? 'selected' : ''; ?>>Church Retreat</option>
									<option value="Youth Group" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Youth Group' ) ? 'selected' : ''; ?>>Youth Group</option>
									<option value="Women's Ministry" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Women\'s Ministry' ) ? 'selected' : ''; ?>>Women's Ministry</option>
									<option value="Men's Ministry" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Men\'s Ministry' ) ? 'selected' : ''; ?>>Men's Ministry</option>
									<option value="Family Camp" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Family Camp' ) ? 'selected' : ''; ?>>Family Camp</option>
									<option value="Other" <?php echo ( isset( $retreat_form_data['retreat_type'] ) && $retreat_form_data['retreat_type'] === 'Other' ) ? 'selected' : ''; ?>>Other</option>
								</select>
								<div id="retreat-type-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['retreat_type'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-type').focus()">
									<?php echo ! empty( $retreat_form_result['errors']['retreat_type'] ) ? esc_html( $retreat_form_result['errors']['retreat_type'] ) : ''; ?>
								</div>
							</div>
						</div>

						<!-- Special Requests Field (Optional) -->
						<div class="mb-6">
							<label for="retreat-requests" class="block text-gray-700 font-semibold mb-2">
								Special Requests
							</label>
							<textarea
								id="retreat-requests"
								name="retreat_requests"
								aria-describedby="requests-error"
								rows="4"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-colors resize-y"
								placeholder="e.g., Need AV equipment, dietary restrictions, accessibility requirements..."
							><?php echo isset( $retreat_form_data['requests'] ) ? esc_textarea( $retreat_form_data['requests'] ) : ''; ?></textarea>
							<p class="text-sm text-gray-500 mt-1">Optional: Let us know about any special needs or equipment requests</p>
							<div id="requests-error" class="text-red-600 text-sm mt-1 hidden cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-requests').focus()"></div>
						</div>

						<!-- Privacy Consent (Required) -->
						<div class="mb-8">
							<label class="flex items-start">
								<input
									type="checkbox"
									id="retreat-consent"
									name="retreat_consent"
									required
									aria-required="true"
									aria-describedby="retreat-consent-error"
									<?php echo ( isset( $retreat_form_data['consent'] ) && $retreat_form_data['consent'] ) ? 'checked' : ''; ?>
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
							<div id="retreat-consent-error" class="text-red-600 text-sm mt-1 <?php echo ( ! empty( $retreat_form_result['errors']['consent'] ) ) ? '' : 'hidden'; ?> cursor-pointer hover:underline" role="alert" onclick="document.getElementById('retreat-consent').focus()">
								<?php echo ! empty( $retreat_form_result['errors']['consent'] ) ? esc_html( $retreat_form_result['errors']['consent'] ) : ''; ?>
							</div>
						</div>

						<!-- Submit Button -->
						<div class="text-center">
							<button
								type="submit"
								id="retreat-submit"
								class="bg-brand-blue hover:bg-brand-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-all duration-200 min-w-[200px] disabled:opacity-50 disabled:cursor-not-allowed"
							>
								<span class="submit-text">Request a Quote</span>
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
						<div id="retreat-form-messages" class="mt-6 hidden"></div>

					</form>
				</div>
			</div>
		</section>

	<?php endwhile; ?>

</main>

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array(
	'wave_from'  => 'gray-50',
	'pre_footer_cta_btn1_label' => __( 'Plan Your Retreat', 'slumber-falls' ),
	'pre_footer_cta_btn1_url'   => '#retreat-inquiry-form',
	'pre_footer_cta_btn2_label' => __( 'Contact Us', 'slumber-falls' ),
	'pre_footer_cta_btn2_url'   => home_url( '/contact/' ),
) ); ?>

<script>
// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
	const smoothScrollLinks = document.querySelectorAll('a[href^="#"].smooth-scroll, a.smooth-scroll');

	smoothScrollLinks.forEach(link => {
		link.addEventListener('click', function(e) {
			e.preventDefault();
			const targetId = this.getAttribute('href');
			const targetElement = document.querySelector(targetId);

			if (targetElement) {
				targetElement.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		});
	});
});

/**
 * Retreat Inquiry Form Client-Side Validation
 */
(function() {
	'use strict';

	const form = document.getElementById('retreat-inquiry-form');
	if (!form) return; // Exit if form not present

	const submitBtn = document.getElementById('retreat-submit');
	const submitText = submitBtn.querySelector('.submit-text');
	const submitLoading = submitBtn.querySelector('.submit-loading');

	// Field elements
	const fields = {
		orgName: document.getElementById('retreat-org-name'),
		contactPerson: document.getElementById('retreat-contact-person'),
		email: document.getElementById('retreat-email'),
		phone: document.getElementById('retreat-phone'),
		arrival: document.getElementById('retreat-arrival'),
		departure: document.getElementById('retreat-departure'),
		groupSize: document.getElementById('retreat-group-size'),
		retreatType: document.getElementById('retreat-type'),
		requests: document.getElementById('retreat-requests'),
		consent: document.getElementById('retreat-consent')
	};

	// Error message elements
	const errors = {
		orgName: document.getElementById('org-name-error'),
		contactPerson: document.getElementById('contact-person-error'),
		email: document.getElementById('retreat-email-error'),
		phone: document.getElementById('retreat-phone-error'),
		arrival: document.getElementById('arrival-error'),
		departure: document.getElementById('departure-error'),
		groupSize: document.getElementById('group-size-error'),
		retreatType: document.getElementById('retreat-type-error'),
		requests: document.getElementById('requests-error'),
		consent: document.getElementById('retreat-consent-error')
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
			case 'orgName':
				if (!field.value.trim()) {
					showError('orgName', 'Please enter your organization name');
					isValid = false;
				}
				break;

			case 'contactPerson':
				if (!field.value.trim()) {
					showError('contactPerson', 'Please enter your name');
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

			case 'phone':
				if (!field.value.trim()) {
					showError('phone', 'Please enter your phone number');
					isValid = false;
				}
				break;

			case 'groupSize':
				if (!field.value || field.value < 1) {
					showError('groupSize', 'Please enter your group size');
					isValid = false;
				} else if (isNaN(field.value)) {
					showError('groupSize', 'Please enter a valid number');
					isValid = false;
				}
				break;

			case 'retreatType':
				if (!field.value) {
					showError('retreatType', 'Please select a retreat type');
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
		['orgName', 'contactPerson', 'email', 'phone', 'groupSize', 'retreatType', 'consent'].forEach(function(fieldName) {
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
	form.addEventListener('submit', handleSubmit);

	// Real-time validation on blur
	Object.keys(fields).forEach(function(fieldName) {
		if (fields[fieldName]) {
			fields[fieldName].addEventListener('blur', function() {
				if (this.value || this.type === 'checkbox' || fieldName === 'retreatType') {
					validateField(fieldName);
				}
			});

			// Clear error on input
			fields[fieldName].addEventListener('input', function() {
				if (errors[fieldName] && !errors[fieldName].classList.contains('hidden')) {
					clearError(fieldName);
				}
			});

			// For select dropdown, also listen to change event
			if (fieldName === 'retreatType') {
				fields[fieldName].addEventListener('change', function() {
					if (errors[fieldName] && !errors[fieldName].classList.contains('hidden')) {
						clearError(fieldName);
					}
				});
			}
		}
	});

})();
</script>

<?php
get_footer();
