<?php
/**
 * The template for displaying a single Activity
 *
 * @package Slumber_Falls
 */

get_header();
?>

<nav class="breadcrumb bg-gray-100 py-3 px-4" aria-label="<?php esc_attr_e( 'Breadcrumb', 'slumber-falls' ); ?>">
	<div class="max-w-4xl mx-auto">
		<ol class="flex items-center space-x-2 text-sm">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-brand-green hover:underline">
					<?php esc_html_e( 'Home', 'slumber-falls' ); ?>
				</a>
			</li>
			<li>
				<span class="text-gray-400 mx-2">&gt;</span>
			</li>
			<li>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'activity' ) ); ?>" class="text-brand-green hover:underline">
					<?php esc_html_e( 'Activities', 'slumber-falls' ); ?>
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
		// Get activity category meta.
		$category = get_post_meta( get_the_ID(), 'activity_category', true );
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto py-8 px-4' ); ?>>
			<!-- Activity Header -->
			<header class="activity-header mb-8">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="activity-featured-image mb-6">
						<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg shadow-lg' ) ); ?>
					</div>
				<?php endif; ?>

				<h1 class="text-3xl md:text-4xl font-bold text-brand-green mb-4">
					<?php the_title(); ?>
				</h1>

				<?php if ( $category ) : ?>
					<div class="mb-4">
						<span class="inline-block px-4 py-2 text-sm font-semibold text-white bg-brand-green rounded-full">
							<?php echo esc_html( $category ); ?>
						</span>
					</div>
				<?php endif; ?>
			</header>

			<!-- Activity Description -->
			<div class="activity-description prose prose-lg max-w-none mb-12">
				<?php the_content(); ?>
			</div>

			<!-- Camps Offering This Activity Section -->
			<?php
			// Reverse query to find camps where this activity is assigned.
			$current_activity_id = get_the_ID();

			$camps_query = new WP_Query(
				array(
					'post_type'      => 'camp',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => 'camp_activities',
							'value'   => 'i:' . $current_activity_id . ';',
							'compare' => 'LIKE',
						),
					),
				)
			);

			if ( $camps_query->have_posts() ) :
				?>
				<section class="activity-camps my-12">
					<h2 class="text-3xl font-bold text-brand-green mb-6">
						<?php esc_html_e( 'Camps Offering This Activity', 'slumber-falls' ); ?>
					</h2>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
						<?php
						while ( $camps_query->have_posts() ) :
							$camps_query->the_post();
							$start_date = get_post_meta( get_the_ID(), 'camp_start_date', true );
							$end_date   = get_post_meta( get_the_ID(), 'camp_end_date', true );
							$age_group  = get_post_meta( get_the_ID(), 'camp_age_group', true );
							$price      = get_post_meta( get_the_ID(), 'camp_price', true );
							?>
							<div class="camp-card bg-white rounded-lg shadow hover:shadow-lg transition p-6">
								<h3 class="text-xl font-semibold mb-3">
									<a href="<?php the_permalink(); ?>" class="text-brand-green hover:text-brand-green-600 transition-colors">
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
									<p class="text-gray-600 mb-2">
										<span class="font-medium"><?php esc_html_e( 'Ages:', 'slumber-falls' ); ?></span>
										<?php echo esc_html( $age_group ); ?>
									</p>
								<?php endif; ?>

								<?php if ( $price ) : ?>
									<p class="text-gray-600 mb-3">
										<span class="font-medium"><?php esc_html_e( 'Price:', 'slumber-falls' ); ?></span>
										<span class="text-brand-green font-bold"><?php echo esc_html( $price ); ?></span>
									</p>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				</section>
				<?php
				wp_reset_postdata();
			else :
				?>
				<section class="activity-camps my-12">
					<h2 class="text-3xl font-bold text-brand-green mb-6">
						<?php esc_html_e( 'Camps Offering This Activity', 'slumber-falls' ); ?>
					</h2>
					<p class="text-gray-600">
						<?php esc_html_e( 'This activity will be offered in upcoming camps.', 'slumber-falls' ); ?>
					</p>
				</section>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>
</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
