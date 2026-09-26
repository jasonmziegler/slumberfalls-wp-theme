<?php
/**
 * The template for displaying the Camps archive
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- Breadcrumb -->
	<nav class="breadcrumb bg-gray-100 py-3 px-4" aria-label="<?php esc_attr_e( 'Breadcrumb', 'slumber-falls' ); ?>">
		<div class="max-w-6xl mx-auto">
			<ol class="flex items-center space-x-2 text-sm list-none">
				<li>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-brand-blue hover:underline">
						<?php esc_html_e( 'Home', 'slumber-falls' ); ?>
					</a>
				</li>
				<li>
					<span class="text-gray-400 mx-2">&gt;</span>
				</li>
				<li class="text-gray-600" aria-current="page">
					<?php esc_html_e( 'Camps', 'slumber-falls' ); ?>
				</li>
			</ol>
		</div>
	</nav>

	<header class="page-header bg-brand-blue text-white py-12 px-4">
		<div class="max-w-6xl mx-auto text-center">
			<h1 class="text-4xl md:text-5xl font-bold mb-3">
				<?php esc_html_e( 'Summer Camps & Retreats', 'slumber-falls' ); ?>
			</h1>
			<p class="text-xl text-blue-100">
				<?php esc_html_e( '68+ years of faith-based outdoor adventure', 'slumber-falls' ); ?>
			</p>
		</div>
	</header>

	<section class="camps-grid bg-white py-12 pb-16 px-4">
		<div class="max-w-6xl mx-auto">
			<!-- Results Count -->
			<div id="results-count" class="mb-4 text-gray-600 font-medium"></div>

			<!-- Sort Dropdown -->
			<div class="sort-controls mb-4">
				<label for="sort-camps" class="inline-block text-sm font-medium text-gray-700 mr-2">
					<?php esc_html_e( 'Sort by:', 'slumber-falls' ); ?>
				</label>
				<select id="sort-camps" name="sort-camps" class="px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition-colors">
					<option value="date-asc"><?php esc_html_e( 'Upcoming Dates', 'slumber-falls' ); ?></option>
					<option value="price-asc"><?php esc_html_e( 'Price: Low to High', 'slumber-falls' ); ?></option>
					<option value="price-desc"><?php esc_html_e( 'Price: High to Low', 'slumber-falls' ); ?></option>
				</select>
			</div>

			<!-- Mobile Filter Toggle Button -->
			<button id="filter-toggle" type="button"
				class="md:hidden w-full mb-4 px-6 py-3 bg-brand-blue text-white font-medium rounded-md hover:bg-brand-blue-600 focus:ring-2 focus:ring-brand-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-between"
				aria-expanded="false"
				aria-controls="filter-panel">
				<span><?php esc_html_e( 'Filter Camps', 'slumber-falls' ); ?></span>
				<span id="filter-count" class="hidden ml-2 px-2 py-1 bg-brand-yellow text-black text-sm rounded-full"></span>
			</button>

			<!-- Camp Filters -->
			<div id="filter-panel" class="camp-filters mb-8 bg-white p-6 rounded-lg shadow hidden md:block">
				<div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
					<!-- Age Group Filter -->
					<div class="flex-1">
						<label for="age-filter" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Age Group', 'slumber-falls' ); ?>
						</label>
						<select id="age-filter" name="age-filter" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition-colors">
							<option value=""><?php esc_html_e( 'All Ages', 'slumber-falls' ); ?></option>
							<option value="Ages 6-8"><?php esc_html_e( 'Ages 6-8', 'slumber-falls' ); ?></option>
							<option value="Ages 8-10"><?php esc_html_e( 'Ages 8-10', 'slumber-falls' ); ?></option>
							<option value="Ages 10-12"><?php esc_html_e( 'Ages 10-12', 'slumber-falls' ); ?></option>
							<option value="Ages 12-15"><?php esc_html_e( 'Ages 12-15', 'slumber-falls' ); ?></option>
							<option value="Ages 15-18"><?php esc_html_e( 'Ages 15-18', 'slumber-falls' ); ?></option>
						</select>
					</div>

					<!-- Camp Type Filter -->
					<div class="flex-1">
						<label for="type-filter" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Camp Type', 'slumber-falls' ); ?>
						</label>
						<select id="type-filter" name="type-filter" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition-colors">
							<option value=""><?php esc_html_e( 'All Types', 'slumber-falls' ); ?></option>
							<option value="Overnight"><?php esc_html_e( 'Overnight', 'slumber-falls' ); ?></option>
							<option value="Day Camp"><?php esc_html_e( 'Day Camp', 'slumber-falls' ); ?></option>
							<option value="Retreat"><?php esc_html_e( 'Retreat', 'slumber-falls' ); ?></option>
						</select>
					</div>

					<!-- Date Range Filters -->
					<div class="flex-1">
						<label for="date-from" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Available From', 'slumber-falls' ); ?>
						</label>
						<input type="date" id="date-from" name="date-from" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition-colors">
					</div>

					<div class="flex-1">
						<label for="date-to" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Available To', 'slumber-falls' ); ?>
						</label>
						<input type="date" id="date-to" name="date-to" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition-colors">
					</div>

					<!-- Reset Filters Button -->
					<div class="flex items-end">
						<button id="reset-filters" type="button" class="w-full md:w-auto px-6 py-3 bg-brand-blue text-white font-medium rounded-md hover:bg-brand-blue-600 focus:ring-2 focus:ring-brand-blue-500 focus:ring-offset-2 transition-colors">
							<?php esc_html_e( 'Reset Filters', 'slumber-falls' ); ?>
						</button>
					</div>
				</div>
			</div>

			<!-- No Results Message (Hidden by default) -->
			<div id="no-results-message" class="hidden text-center p-8 bg-yellow-50 rounded-lg mb-8">
				<p class="text-lg text-gray-700"><?php esc_html_e( 'No camps match your filters. Try adjusting your criteria.', 'slumber-falls' ); ?></p>
			</div>

			<?php
			$args = array(
				'post_type'      => 'camp',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_key'       => 'camp_start_date',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'meta_query'     => array(
					array(
						'key'     => 'camp_start_date',
						'compare' => 'EXISTS',
					),
				),
			);

			$camps_query = new WP_Query( $args );
			?>

			<?php if ( $camps_query->have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<?php while ( $camps_query->have_posts() ) : $camps_query->the_post(); ?>
						<?php
						// Get camp meta data.
						$start_date = get_post_meta( get_the_ID(), 'camp_start_date', true );
						$end_date   = get_post_meta( get_the_ID(), 'camp_end_date', true );
						$age_group  = get_post_meta( get_the_ID(), 'camp_age_group', true );
						$camp_type  = get_post_meta( get_the_ID(), 'camp_type', true );
						$price      = get_post_meta( get_the_ID(), 'camp_price', true );
						$featured   = get_post_meta( get_the_ID(), 'camp_featured', true );

						// Extract numeric price for sorting.
						$price_numeric = 0;
						if ( $price ) {
							$price_numeric = preg_replace( '/[^0-9.]/', '', $price );
						}

						// Camp type badge colors.
						$badge_class       = 'bg-gray-100 text-gray-800';
						$camp_type_display = '';
						if ( $camp_type === 'overnight' ) {
							$badge_class       = 'bg-blue-100 text-blue-800';
							$camp_type_display = __( 'Overnight', 'slumber-falls' );
						} elseif ( $camp_type === 'day_camp' ) {
							$badge_class       = 'bg-yellow-100 text-yellow-800';
							$camp_type_display = __( 'Day Camp', 'slumber-falls' );
						} elseif ( $camp_type === 'retreat' ) {
							$badge_class       = 'bg-green-100 text-green-800';
							$camp_type_display = __( 'Retreat', 'slumber-falls' );
						}
						?>

						<article class="camp-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 transform transition duration-300 hover:scale-105 hover:shadow-xl relative"
							data-age-group="<?php echo esc_attr( $age_group ); ?>"
							data-camp-type="<?php echo esc_attr( $camp_type ); ?>"
							data-start-date="<?php echo esc_attr( $start_date ); ?>"
							data-end-date="<?php echo esc_attr( $end_date ); ?>"
							data-price="<?php echo esc_attr( $price_numeric ); ?>">

							<!-- Featured Ribbon -->
							<?php if ( $featured ) : ?>
								<div class="absolute top-3 right-3 z-10">
									<div class="bg-brand-yellow text-black px-4 py-2 text-xs font-bold uppercase shadow-lg rounded">
										<?php esc_html_e( 'Featured', 'slumber-falls' ); ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="camp-card__image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="camp-card__image bg-gray-200 h-48 flex items-center justify-center">
									<span class="text-gray-400 text-sm"><?php esc_html_e( 'No image', 'slumber-falls' ); ?></span>
								</div>
							<?php endif; ?>

							<div class="camp-card__content p-6">
								<h2 class="text-xl font-semibold mb-2">
									<a href="<?php the_permalink(); ?>" class="text-brand-blue hover:text-brand-blue-700 transition-colors">
										<?php the_title(); ?>
									</a>
								</h2>

								<?php if ( $start_date && $end_date ) : ?>
									<p class="text-gray-600 mb-2">
										<span class="font-medium"><?php esc_html_e( 'Dates:', 'slumber-falls' ); ?></span>
										<?php
										echo esc_html( date_i18n( 'M j', strtotime( $start_date ) ) );
										echo ' - ';
										echo esc_html( date_i18n( 'M j, Y', strtotime( $end_date ) ) );
										?>
									</p>
								<?php endif; ?>

								<?php if ( $age_group ) : ?>
									<p class="text-gray-600 mb-2">
										<span class="font-medium"><?php esc_html_e( 'Ages:', 'slumber-falls' ); ?></span>
										<?php echo esc_html( $age_group ); ?>
									</p>
								<?php endif; ?>

								<!-- Camp Type Badge -->
								<?php if ( $camp_type_display ) : ?>
									<div class="mb-3">
										<span class="inline-block px-3 py-1 text-sm font-semibold rounded-full <?php echo esc_attr( $badge_class ); ?>">
											<?php echo esc_html( $camp_type_display ); ?>
										</span>
									</div>
								<?php endif; ?>

								<?php if ( $price ) : ?>
									<p class="text-brand-green font-bold text-lg">
										<?php echo esc_html( $price ); ?>
									</p>
								<?php endif; ?>
							</div>
						</article>

					<?php endwhile; ?>
				</div>

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<div class="no-camps text-center py-12 px-4">
					<div class="max-w-2xl mx-auto bg-blue-50 border-2 border-brand-blue rounded-lg p-8">
						<h2 class="text-2xl font-bold text-brand-blue mb-4">
							<?php esc_html_e( 'Coming Soon!', 'slumber-falls' ); ?>
						</h2>
						<p class="text-gray-700 text-lg mb-2">
							<?php esc_html_e( 'Camps for Summer 2026 coming soon!', 'slumber-falls' ); ?>
						</p>
						<p class="text-gray-600">
							<?php esc_html_e( 'Check back in January for our full summer schedule.', 'slumber-falls' ); ?>
						</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array(
	'wave_from'  => 'white',
	'pre_footer_cta_btn1_label' => __( 'Register Now', 'slumber-falls' ),
	'pre_footer_cta_btn1_url'   => home_url( '/camps/' ),
) ); ?>

<?php
get_footer();
