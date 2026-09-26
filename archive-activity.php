<?php
/**
 * The template for displaying the Activities archive
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header bg-brand-green text-white py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<h1 class="text-4xl font-bold"><?php esc_html_e( 'Camp Activities', 'slumber-falls' ); ?></h1>
		</div>
	</header>

	<section class="activities-grid py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<?php
			$args = array(
				'post_type'      => 'activity',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			);

			$activities_query = new WP_Query( $args );
			?>

			<?php if ( $activities_query->have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<?php while ( $activities_query->have_posts() ) : $activities_query->the_post(); ?>
						<?php
						// Get activity category meta.
						$category = get_post_meta( get_the_ID(), 'activity_category', true );
						?>

						<article class="activity-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="activity-card__image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="activity-card__image">
									<div class="w-full h-48 bg-gray-200 flex items-center justify-center">
										<span class="text-gray-400 text-sm"><?php esc_html_e( 'No image', 'slumber-falls' ); ?></span>
									</div>
								</div>
							<?php endif; ?>

							<div class="activity-card__content p-6">
								<?php if ( $category ) : ?>
									<div class="mb-3">
										<span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-brand-green rounded-full">
											<?php echo esc_html( $category ); ?>
										</span>
									</div>
								<?php endif; ?>

								<h2 class="text-xl font-semibold mb-3">
									<a href="<?php the_permalink(); ?>" class="text-brand-green hover:text-brand-green-700 transition-colors">
										<?php the_title(); ?>
									</a>
								</h2>

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
				<div class="no-activities text-center py-12">
					<p class="text-gray-600 text-lg"><?php esc_html_e( 'No activities found. Check back soon!', 'slumber-falls' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
