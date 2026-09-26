<?php
/**
 * The template for displaying the Instructors archive
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header bg-brand-blue text-white py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<h1 class="text-4xl font-bold"><?php esc_html_e( 'Our Instructors', 'slumber-falls' ); ?></h1>
		</div>
	</header>

	<section class="instructors-grid bg-white py-12 pb-16 px-4">
		<div class="max-w-6xl mx-auto">
			<?php
			$args = array(
				'post_type'      => 'instructor',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			);

			$instructors_query = new WP_Query( $args );
			?>

			<?php if ( $instructors_query->have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<?php while ( $instructors_query->have_posts() ) : $instructors_query->the_post(); ?>

						<article class="instructor-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow p-6 text-center">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="instructor-card__image mb-4">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'w-32 h-32 object-cover rounded-full mx-auto' ) ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="instructor-card__image mb-4">
									<div class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center">
										<span class="text-gray-400 text-sm"><?php esc_html_e( 'No image', 'slumber-falls' ); ?></span>
									</div>
								</div>
							<?php endif; ?>

							<div class="instructor-card__content">
								<h2 class="text-xl font-semibold mb-2">
									<a href="<?php the_permalink(); ?>" class="text-brand-blue hover:text-brand-blue-700 transition-colors">
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
				<div class="no-instructors text-center py-12">
					<p class="text-gray-600 text-lg"><?php esc_html_e( 'No instructors found. Check back soon!', 'slumber-falls' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
