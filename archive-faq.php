<?php
/**
 * The template for displaying the FAQ archive with accordion UI
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header bg-brand-blue text-white py-12 px-4">
		<div class="max-w-4xl mx-auto">
			<h1 class="text-4xl font-bold"><?php esc_html_e( 'Frequently Asked Questions', 'slumber-falls' ); ?></h1>
		</div>
	</header>

	<section class="faqs-accordion py-12 px-4">
		<div class="max-w-4xl mx-auto">
			<?php
			// Query all FAQs ordered by display order.
			$args = array(
				'post_type'      => 'faq',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_key'       => 'faq_display_order',
				'orderby'        => 'meta_value_num',
				'order'          => 'ASC',
			);

			$faqs_query = new WP_Query( $args );

			if ( $faqs_query->have_posts() ) :
				// Group FAQs by category.
				$faqs_by_category = array();
				while ( $faqs_query->have_posts() ) :
					$faqs_query->the_post();
					$category = get_post_meta( get_the_ID(), 'faq_category', true );
					if ( ! empty( $category ) ) {
						if ( ! isset( $faqs_by_category[ $category ] ) ) {
							$faqs_by_category[ $category ] = array();
						}
						$faqs_by_category[ $category ][] = $post;
					}
				endwhile;
				wp_reset_postdata();

				// Define category display order.
				$category_order = array( 'Registration', 'Packing', 'Medical', 'Policies', 'General' );

				// Display FAQs grouped by category.
				$category_index = 0;
				foreach ( $category_order as $category ) :
					if ( isset( $faqs_by_category[ $category ] ) ) :
						$category_id = sanitize_title( $category );
						?>
						<div class="category-accordion mb-6" data-category="<?php echo esc_attr( $category_id ); ?>">
							<!-- Category Header -->
							<button
								class="category-trigger w-full text-left bg-gray-100 hover:bg-gray-200 transition-colors p-4 rounded-lg flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-brand-blue focus:ring-offset-2"
								aria-expanded="<?php echo $category_index === 0 ? 'true' : 'false'; ?>"
								aria-controls="category-<?php echo esc_attr( $category_id ); ?>"
							>
								<span class="text-xl font-semibold text-gray-900"><?php echo esc_html( $category ); ?></span>
								<svg class="category-icon w-6 h-6 text-brand-blue transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
								</svg>
							</button>

							<!-- Category Content -->
							<div
								id="category-<?php echo esc_attr( $category_id ); ?>"
								class="category-content overflow-hidden transition-all duration-300"
								aria-hidden="<?php echo $category_index === 0 ? 'false' : 'true'; ?>"
								style="max-height: <?php echo $category_index === 0 ? '5000px' : '0'; ?>;"
							>
								<div class="mt-4 space-y-3">
									<?php
									$faq_index = 0;
									foreach ( $faqs_by_category[ $category ] as $faq ) :
										setup_postdata( $faq );
										$faq_id = 'faq-' . $faq->ID;
										?>
										<div class="faq-item border border-gray-200 rounded-lg">
											<!-- FAQ Question -->
											<button
												class="faq-trigger w-full text-left p-4 hover:bg-gray-50 transition-colors flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-brand-blue focus:ring-offset-2"
												aria-expanded="false"
												aria-controls="<?php echo esc_attr( $faq_id ); ?>"
											>
												<span class="font-medium text-gray-900 pr-4"><?php echo esc_html( get_the_title( $faq ) ); ?></span>
												<svg class="faq-icon w-5 h-5 text-brand-blue transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
												</svg>
											</button>

											<!-- FAQ Answer -->
											<div
												id="<?php echo esc_attr( $faq_id ); ?>"
												class="faq-content overflow-hidden transition-all duration-300"
												aria-hidden="true"
												style="max-height: 0;"
											>
												<div class="p-4 pt-0 text-gray-700 prose prose-sm max-w-none">
													<?php echo wp_kses_post( apply_filters( 'the_content', $faq->post_content ) ); ?>
												</div>
											</div>
										</div>
										<?php
										$faq_index++;
									endforeach;
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
						<?php
						$category_index++;
					endif;
				endforeach;
			else :
				?>
				<div class="no-faqs text-center py-12">
					<p class="text-gray-600 text-lg"><?php esc_html_e( 'No FAQs found. Check back soon!', 'slumber-falls' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
