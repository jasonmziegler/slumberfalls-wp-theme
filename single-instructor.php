<?php
/**
 * The template for displaying a single Instructor
 *
 * @package Slumber_Falls
 */

get_header();
?>

<nav class="breadcrumb bg-gray-100 py-3 px-4" aria-label="<?php esc_attr_e( 'Breadcrumb', 'slumber-falls' ); ?>">
	<div class="max-w-4xl mx-auto">
		<ol class="flex items-center space-x-2 text-sm">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-brand-blue hover:underline">
					<?php esc_html_e( 'Home', 'slumber-falls' ); ?>
				</a>
			</li>
			<li>
				<span class="text-gray-400 mx-2">&gt;</span>
			</li>
			<li>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'instructor' ) ); ?>" class="text-brand-blue hover:underline">
					<?php esc_html_e( 'Instructors', 'slumber-falls' ); ?>
				</a>
			</li>
			<li>
				<span class="text-gray-400 mx-2">&gt;</span>
			</li>
			<li class="text-gray-600" aria-current="page">
				<?php the_title(); ?>
			</li>
		</ol>
	</div>
</nav>

<main id="primary" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		// Get instructor meta data.
		$credentials = get_post_meta( get_the_ID(), 'instructor_credentials', true );
		$years       = get_post_meta( get_the_ID(), 'instructor_years', true );
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto py-8 px-4' ); ?>>
			<!-- Instructor Header with Photo -->
			<header class="instructor-header mb-8 text-center">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="instructor-featured-image mb-6">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'w-48 h-48 object-cover rounded-full mx-auto shadow-lg' ) ); ?>
					</div>
				<?php endif; ?>

				<h1 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">
					<?php the_title(); ?>
				</h1>
			</header>

			<!-- Instructor Details -->
			<?php if ( $credentials || $years ) : ?>
				<div class="instructor-details grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-lg">
					<!-- Credentials -->
					<?php if ( $credentials ) : ?>
						<div class="detail-item">
							<span class="block text-sm text-gray-500 uppercase tracking-wide mb-2">
								<?php esc_html_e( 'Credentials', 'slumber-falls' ); ?>
							</span>
							<div class="text-gray-900">
								<?php echo wp_kses_post( nl2br( $credentials ) ); ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Years at Camp -->
					<?php if ( $years ) : ?>
						<div class="detail-item">
							<span class="block text-sm text-gray-500 uppercase tracking-wide mb-2">
								<?php esc_html_e( 'Years at Camp', 'slumber-falls' ); ?>
							</span>
							<span class="text-lg font-semibold text-gray-900">
								<?php echo esc_html( $years ); ?>
							</span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<!-- Instructor Bio -->
			<div class="instructor-bio prose prose-lg max-w-none">
				<h2 class="text-2xl font-bold text-brand-blue mb-4">
					<?php esc_html_e( 'About', 'slumber-falls' ); ?>
				</h2>
				<?php the_content(); ?>
			</div>

			<!-- Teaching These Camps Section -->
			<?php
			// Reverse query to find camps where this instructor is assigned.
			$current_instructor_id = get_the_ID();

			$camps_query = new WP_Query(
				array(
					'post_type'      => 'camp',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => 'camp_instructors',
							'value'   => 'i:' . $current_instructor_id . ';',
							'compare' => 'LIKE',
						),
					),
				)
			);

			if ( $camps_query->have_posts() ) :
				?>
				<section class="instructor-camps my-12">
					<h2 class="text-3xl font-bold text-brand-blue mb-6">
						<?php esc_html_e( 'Teaching These Camps', 'slumber-falls' ); ?>
					</h2>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
						<?php
						while ( $camps_query->have_posts() ) :
							$camps_query->the_post();
							$start_date = get_post_meta( get_the_ID(), 'camp_start_date', true );
							$end_date   = get_post_meta( get_the_ID(), 'camp_end_date', true );
							$age_group  = get_post_meta( get_the_ID(), 'camp_age_group', true );
							$camp_type  = get_post_meta( get_the_ID(), 'camp_type', true );

							// Format camp type for badge.
							$camp_type_labels = array(
								'overnight' => __( 'Overnight Camp', 'slumber-falls' ),
								'day_camp'  => __( 'Day Camp', 'slumber-falls' ),
								'retreat'   => __( 'Retreat', 'slumber-falls' ),
							);
							$camp_type_display = isset( $camp_type_labels[ $camp_type ] ) ? $camp_type_labels[ $camp_type ] : '';

							// Badge color classes.
							$badge_classes = '';
							switch ( $camp_type ) {
								case 'overnight':
									$badge_classes = 'bg-brand-blue text-white';
									break;
								case 'day_camp':
									$badge_classes = 'bg-brand-yellow text-black';
									break;
								case 'retreat':
									$badge_classes = 'bg-brand-green text-white';
									break;
								default:
									$badge_classes = 'bg-gray-200 text-gray-700';
							}
							?>
							<div class="camp-card bg-white rounded-lg shadow hover:shadow-lg transition p-6">
								<h3 class="text-xl font-semibold mb-3">
									<a href="<?php the_permalink(); ?>" class="text-brand-blue hover:text-brand-blue-600 transition-colors">
										<?php the_title(); ?>
									</a>
								</h3>

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
									<p class="text-gray-600 mb-3">
										<span class="font-medium"><?php esc_html_e( 'Ages:', 'slumber-falls' ); ?></span>
										<?php echo esc_html( $age_group ); ?>
									</p>
								<?php endif; ?>

								<?php if ( $camp_type_display ) : ?>
									<span class="inline-block px-3 py-1 rounded-full text-sm font-medium <?php echo esc_attr( $badge_classes ); ?>">
										<?php echo esc_html( $camp_type_display ); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				</section>
				<?php
				wp_reset_postdata();
			else :
				?>
				<section class="instructor-camps my-12">
					<h2 class="text-3xl font-bold text-brand-blue mb-6">
						<?php esc_html_e( 'Teaching These Camps', 'slumber-falls' ); ?>
					</h2>
					<p class="text-gray-600">
						<?php esc_html_e( 'No upcoming camps scheduled.', 'slumber-falls' ); ?>
					</p>
				</section>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>
</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
