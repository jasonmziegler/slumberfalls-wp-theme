<?php
/**
 * The template for displaying the Camps archive
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header bg-brand-blue text-white py-12 px-4">
		<div class="max-w-6xl mx-auto">
			<h1 class="text-4xl font-bold"><?php esc_html_e( 'Summer Camps', 'slumber-falls' ); ?></h1>
		</div>
	</header>

	<section class="camps-grid py-12 px-4">
		<div class="max-w-6xl mx-auto">
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
						$price      = get_post_meta( get_the_ID(), 'camp_price', true );
						?>

						<article class="camp-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
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
				<div class="no-camps text-center py-12">
					<p class="text-gray-600 text-lg"><?php esc_html_e( 'No camps are currently scheduled. Check back soon!', 'slumber-falls' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
