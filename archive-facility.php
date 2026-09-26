<?php
/**
 * The template for displaying the Facilities archive
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header bg-brand-brown text-white py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<h1 class="text-4xl font-bold"><?php esc_html_e( 'Our Facilities', 'slumber-falls' ); ?></h1>
		</div>
	</header>

	<section class="facilities-grid py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<?php
			$args = array(
				'post_type'      => 'facility',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			);

			$facilities_query = new WP_Query( $args );
			?>

			<?php if ( $facilities_query->have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<?php while ( $facilities_query->have_posts() ) : $facilities_query->the_post(); ?>
						<?php
						// Get facility meta data.
						$capacity           = get_post_meta( get_the_ID(), 'facility_capacity', true );
						$available_retreats = get_post_meta( get_the_ID(), 'facility_available_retreats', true );
						?>

						<article class="facility-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="facility-card__image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="facility-card__image">
									<div class="w-full h-48 bg-gray-200 flex items-center justify-center">
										<span class="text-gray-400 text-sm"><?php esc_html_e( 'No image', 'slumber-falls' ); ?></span>
									</div>
								</div>
							<?php endif; ?>

							<div class="facility-card__content p-6">
								<?php if ( $available_retreats === '1' ) : ?>
									<div class="mb-3">
										<span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-brand-blue rounded-full">
											<?php esc_html_e( 'Available for Retreats', 'slumber-falls' ); ?>
										</span>
									</div>
								<?php endif; ?>

								<h2 class="text-xl font-semibold mb-3">
									<a href="<?php the_permalink(); ?>" class="text-brand-brown hover:text-brand-brown-700 transition-colors">
										<?php the_title(); ?>
									</a>
								</h2>

								<?php if ( $capacity ) : ?>
									<div class="text-gray-600 text-sm mb-3">
										<strong><?php esc_html_e( 'Capacity:', 'slumber-falls' ); ?></strong> <?php echo esc_html( $capacity ); ?>
									</div>
								<?php endif; ?>

								<?php if ( has_excerpt() ) : ?>
									<div class="text-gray-600 text-sm">
										<?php the_excerpt(); ?>
									</div>
								<?php endif; ?>
							</div>
						</article>

					<?php endwhile; ?>
				</div>

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<div class="no-facilities text-center py-12">
					<p class="text-gray-600 text-lg"><?php esc_html_e( 'No facilities found. Check back soon!', 'slumber-falls' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array(
	'wave_from'                  => 'white',
	'pre_footer_cta_btn1_label'  => __( 'Plan a Retreat', 'slumber-falls' ),
	'pre_footer_cta_btn1_url'    => home_url( '/retreats/' ),
) ); ?>

<?php
get_footer();
