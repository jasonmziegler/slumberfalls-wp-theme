<?php
/**
 * The template for displaying the homepage
 *
 * This is the template that displays the front page (homepage).
 * WordPress automatically uses this template for the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Slumber_Falls
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		$hero_image_id  = get_theme_mod( 'hero_background_image', '' );
		$hero_image_url = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : '';
		$hero_has_image = ! empty( $hero_image_url );
		?>

		<!-- Hero Section -->
		<section id="hero" class="hero-section relative min-h-[70vh] md:h-screen flex items-center justify-center bg-gradient-to-br from-brand-blue-700 to-brand-blue-900 bg-cover bg-center bg-no-repeat"
			<?php if ( $hero_has_image ) : ?>
				style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"
			<?php endif; ?>>

			<?php if ( $hero_has_image ) : ?>
			<!-- Dot Pattern Overlay -->
			<div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>

			<!-- Dark Overlay for Text Readability -->
			<div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/40"></div>
			<?php else : ?>
			<!-- Gradient overlay when no image is set -->
			<div class="absolute inset-0 bg-gradient-to-b from-brand-blue-800/60 to-brand-blue-900/80"></div>
			<?php endif; ?>

			<!-- Hero Content -->
			<div class="relative z-10 container mx-auto px-4 text-center text-white opacity-0 animate-fade-in-up">
				<h1 class="font-display text-display-sm md:text-display lg:text-display-lg mb-4 md:mb-6">
					Faith-Based Summer Camps & Retreats
				</h1>
				<p class="font-heading text-lg md:text-xl lg:text-2xl mb-8 md:mb-10 max-w-4xl mx-auto leading-relaxed">
					68+ years of outdoor adventure, spiritual growth, and lifelong friendships in New Braunfels, Texas
				</p>

				<!-- CTA Buttons -->
				<div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
					<a href="<?php echo esc_url( home_url( '/camps/' ) ); ?>"
					   class="inline-block bg-accent-gold hover:bg-accent-gold-500 text-gray-900 font-semibold px-8 py-4 rounded-full shadow-button hover:shadow-button-hover transition-all duration-300 hover:scale-105 min-h-[44px] min-w-[200px] text-center">
						Explore Summer Camps
					</a>
					<a href="<?php echo esc_url( home_url( '/retreats/' ) ); ?>"
					   class="inline-block bg-white/10 backdrop-blur-sm border-2 border-white/30 hover:bg-white/20 text-white font-semibold px-8 py-4 rounded-full shadow-button hover:shadow-button-hover transition-all duration-300 hover:scale-105 min-h-[44px] min-w-[200px] text-center">
						Plan Your Retreat
					</a>
				</div>
			</div>
		</section>

		<!-- Camp Pathways Section -->
		<section id="camp-pathways" class="camp-pathways-section relative py-12 md:py-16 bg-warm-50">
			<!-- Wave Divider (extends above into hero) -->
			<div class="absolute top-0 left-0 right-0 -translate-y-full pointer-events-none">
				<?php get_template_part( 'template-parts/components/wave-divider', null, array(
					'color'  => 'warm-50',
					'height' => 'h-12 md:h-20',
				) ); ?>
			</div>
			<div class="container mx-auto px-4">
				<h2 class="font-heading text-3xl md:text-4xl font-bold text-center mb-4 text-gray-900">Find Your Camp Experience</h2>
				<p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Choose the perfect camp adventure for your family</p>

				<div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-stagger>
					<!-- Overnight Camps Card -->
					<div class="bg-gradient-to-br from-white via-warm-100 to-brand-blue-50 p-8 rounded-xl shadow-card hover:shadow-card-hover transition-transform duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-brand-blue-300 group" data-animate="fade-in-up">
						<!-- Moon/Tent Icon -->
						<div class="flex justify-center mb-6">
							<svg class="w-20 h-20 text-brand-blue group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
							</svg>
						</div>
						<h3 class="font-heading text-2xl font-bold mb-4 text-center text-gray-900">Overnight Camps</h3>
						<p class="text-gray-600 mb-6 text-center leading-relaxed">Multi-day immersive experiences filled with adventure, faith-building activities, and lasting friendships under the stars.</p>
						<div class="text-center">
							<a href="<?php echo esc_url( home_url( '/camps/?type=overnight' ) ); ?>"
							   class="inline-block bg-brand-blue hover:bg-brand-blue-700 text-white font-heading font-semibold rounded-full px-8 py-3 shadow-button hover:shadow-button-hover transition-all duration-300">
								View Overnight Camps
							</a>
						</div>
					</div>

					<!-- Day Camps Card -->
					<div class="bg-gradient-to-br from-white via-warm-100 to-accent-gold-50 p-8 rounded-xl shadow-card hover:shadow-card-hover transition-transform duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-brand-yellow-300 group" data-animate="fade-in-up">
						<!-- Sun Icon -->
						<div class="flex justify-center mb-6">
							<svg class="w-20 h-20 text-brand-yellow group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
							</svg>
						</div>
						<h3 class="font-heading text-2xl font-bold mb-4 text-center text-gray-900">Day Camps</h3>
						<p class="text-gray-600 mb-6 text-center leading-relaxed">Action-packed daily programs perfect for busy families. Drop off in the morning, pick up in the afternoon—full of fun in between!</p>
						<div class="text-center">
							<a href="<?php echo esc_url( home_url( '/camps/?type=day' ) ); ?>"
							   class="inline-block bg-accent-gold hover:bg-accent-gold-600 text-gray-900 font-heading font-semibold rounded-full px-8 py-3 shadow-button hover:shadow-button-hover transition-all duration-300">
								View Day Camps
							</a>
						</div>
					</div>

					<!-- Retreats Card -->
					<div class="bg-gradient-to-br from-white via-warm-100 to-nature-100 p-8 rounded-xl shadow-card hover:shadow-card-hover transition-transform duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-brand-green-300 group" data-animate="fade-in-up">
						<!-- People/Chapel Icon -->
						<div class="flex justify-center mb-6">
							<svg class="w-20 h-20 text-brand-green group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
							</svg>
						</div>
						<h3 class="font-heading text-2xl font-bold mb-4 text-center text-gray-900">Retreats</h3>
						<p class="text-gray-600 mb-6 text-center leading-relaxed">Custom group retreats for churches, youth groups, and organizations. Bring your community together in our beautiful facilities.</p>
						<div class="text-center">
							<a href="<?php echo esc_url( home_url( '/retreats/' ) ); ?>"
							   class="inline-block bg-brand-green hover:bg-brand-green-700 text-white font-heading font-semibold rounded-full px-8 py-3 shadow-button hover:shadow-button-hover transition-all duration-300">
								Plan a Retreat
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Wave Divider: Camp Pathways → Featured Camps -->
		<?php get_template_part( 'template-parts/components/wave-divider', null, array(
			'color'  => 'white',
			'bg'     => 'warm-50',
			'height' => 'h-12 md:h-20',
		) ); ?>

		<!-- Featured Camps Carousel Section -->
		<section id="featured-camps" class="featured-camps-section py-12 md:py-16 bg-white">
			<div class="container mx-auto px-4">
				<h2 class="font-heading text-3xl md:text-4xl font-bold text-center mb-4 text-gray-900" data-animate="zoom-in">Featured Summer Camps</h2>
				<p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">Discover our most popular camp experiences</p>

				<?php
				// Query featured camps
				$featured_args = array(
					'post_type'      => 'camp',
					'post_status'    => 'publish',
					'posts_per_page' => 5,
					'meta_query'     => array(
						array(
							'key'     => 'camp_featured',
							'value'   => '1',
							'compare' => '=',
						),
					),
					'orderby'        => 'meta_value',
					'meta_key'       => 'camp_start_date',
					'order'          => 'ASC',
				);

				$featured_camps = new WP_Query( $featured_args );

				// Fallback to most recent camps if no featured camps
				if ( ! $featured_camps->have_posts() ) {
					$featured_args = array(
						'post_type'      => 'camp',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'meta_value',
						'meta_key'       => 'camp_start_date',
						'order'          => 'ASC',
					);
					$featured_camps = new WP_Query( $featured_args );
				}

				if ( $featured_camps->have_posts() ) :
				?>

				<div class="relative max-w-5xl mx-auto">
					<!-- Carousel Container -->
					<div class="overflow-hidden rounded-xl">
						<div id="campsCarousel" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth hide-scrollbar">
							<?php
							$slide_index = 0;
							while ( $featured_camps->have_posts() ) :
								$featured_camps->the_post();
								$start_date = get_post_meta( get_the_ID(), 'camp_start_date', true );
								$end_date   = get_post_meta( get_the_ID(), 'camp_end_date', true );
								$price      = get_post_meta( get_the_ID(), 'camp_price', true );
								$age_group  = get_post_meta( get_the_ID(), 'camp_age_group', true );

								// Format dates
								$start_formatted = $start_date ? date( 'M j', strtotime( $start_date ) ) : '';
								$end_formatted   = $end_date ? date( 'M j, Y', strtotime( $end_date ) ) : '';
								$dates_display   = $start_formatted && $end_formatted ? $start_formatted . ' - ' . $end_formatted : 'Dates TBA';
								?>

								<div class="carousel-slide min-w-full snap-center px-4" data-slide="<?php echo esc_attr( $slide_index ); ?>">
									<div class="bg-white rounded-xl shadow-card hover:shadow-card-hover overflow-hidden transition-all duration-300">
										<div class="grid md:grid-cols-2 gap-0">
											<!-- Camp Image -->
											<div class="relative h-64 md:h-auto bg-gray-200">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover' ) );
												} else {
													?>
													<div class="w-full h-full flex items-center justify-center bg-brand-blue-100">
														<svg class="w-24 h-24 text-brand-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
														</svg>
													</div>
													<?php
												}
												?>
											</div>

											<!-- Camp Details -->
											<div class="p-8 flex flex-col justify-center">
												<h3 class="font-heading text-2xl md:text-3xl font-bold mb-3 text-gray-900"><?php the_title(); ?></h3>

												<div class="space-y-3 mb-6">
													<!-- Dates -->
													<div class="flex items-center text-gray-700">
														<svg class="w-5 h-5 mr-3 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
														</svg>
														<span class="font-semibold"><?php echo esc_html( $dates_display ); ?></span>
													</div>

													<!-- Age Group -->
													<?php if ( $age_group ) : ?>
													<div class="flex items-center text-gray-700">
														<svg class="w-5 h-5 mr-3 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
														</svg>
														<span><?php echo esc_html( $age_group ); ?></span>
													</div>
													<?php endif; ?>

													<!-- Price -->
													<?php if ( $price ) : ?>
													<div class="flex items-center text-gray-700">
														<svg class="w-5 h-5 mr-3 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
														</svg>
														<span class="text-xl font-bold text-brand-blue"><?php echo esc_html( $price ); ?></span>
													</div>
													<?php endif; ?>
												</div>

												<div class="excerpt font-sans text-gray-600 mb-6 line-clamp-3">
													<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
												</div>

												<a href="<?php the_permalink(); ?>"
												   class="inline-block bg-brand-blue hover:bg-brand-blue-600 text-white font-heading font-semibold rounded-full px-6 py-2 shadow-button hover:shadow-button-hover transition-all duration-300 text-center">
													Learn More
												</a>
											</div>
										</div>
									</div>
								</div>

								<?php
								$slide_index++;
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>

					<!-- Navigation Arrows -->
					<?php if ( $featured_camps->post_count > 1 ) : ?>
					<button id="prevSlide" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-12 bg-white hover:bg-gray-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10" aria-label="Previous slide">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
						</svg>
					</button>
					<button id="nextSlide" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-12 bg-white hover:bg-gray-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10" aria-label="Next slide">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					</button>

					<!-- Dot Indicators -->
					<div class="flex justify-center gap-2 mt-6" id="carouselDots">
						<?php for ( $i = 0; $i < $featured_camps->post_count; $i++ ) : ?>
						<button class="carousel-dot w-3 h-3 rounded-full transition-all duration-300 <?php echo $i === 0 ? 'bg-brand-blue w-8' : 'bg-gray-300 hover:bg-gray-400'; ?>"
								data-slide="<?php echo esc_attr( $i ); ?>"
								aria-label="Go to slide <?php echo esc_attr( $i + 1 ); ?>">
						</button>
						<?php endfor; ?>
					</div>
					<?php endif; ?>
				</div>

				<?php else : ?>
				<div class="bg-gray-100 p-12 rounded-xl text-center">
					<svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
					</svg>
					<p class="text-gray-500 text-lg">No camps available at this time. Check back soon for upcoming sessions!</p>
				</div>
				<?php endif; ?>

			</div>
		</section>

		<!-- Wave Divider: Featured Camps → Testimonials -->
		<?php get_template_part( 'template-parts/components/wave-divider', null, array(
			'color'  => 'warm-100',
			'bg'     => 'white',
			'height' => 'h-12 md:h-20',
		) ); ?>

		<!-- Testimonials Section -->
		<section id="testimonials" class="testimonials-section relative py-12 md:py-16 bg-warm-100">

			<div class="container mx-auto px-4">
				<h2 class="font-heading text-3xl md:text-4xl font-bold text-center mb-4 text-gray-900 relative z-10">What Families Are Saying</h2>
				<p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Hear from parents and campers about their Slumber Falls experience</p>

				<?php
				// Query featured testimonials
				$testimonial_args = array(
					'post_type'      => 'testimonial',
					'post_status'    => 'publish',
					'posts_per_page' => 3,
					'meta_query'     => array(
						array(
							'key'     => 'testimonial_featured',
							'value'   => '1',
							'compare' => '=',
						),
					),
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				$testimonials = new WP_Query( $testimonial_args );

				// Fallback to most recent testimonials if no featured testimonials
				if ( ! $testimonials->have_posts() ) {
					$testimonial_args = array(
						'post_type'      => 'testimonial',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
					);
					$testimonials = new WP_Query( $testimonial_args );
				}

				if ( $testimonials->have_posts() ) :
				?>

				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10" data-stagger>
					<?php
					while ( $testimonials->have_posts() ) :
						$testimonials->the_post();
						$parent_name = get_post_meta( get_the_ID(), 'testimonial_parent_name', true );
						$year        = get_post_meta( get_the_ID(), 'testimonial_year', true );
						?>

						<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl shadow-card hover:shadow-card-hover border-2 border-warm-300 hover:border-accent-gold-400 transition-all duration-300 hover:-translate-y-2 relative" data-animate="fade-in-up">
							<!-- Large Quote Icon -->
							<div class="absolute top-6 right-6 opacity-10">
								<svg class="w-24 h-24 text-accent-gold-400" fill="currentColor" viewBox="0 0 24 24">
									<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
								</svg>
							</div>

							<!-- Testimonial Text -->
							<div class="relative z-10 mb-6">
								<p class="font-sans text-gray-700 italic leading-relaxed text-lg">
									"<?php echo wp_kses_post( get_the_content() ); ?>"
								</p>
							</div>

							<!-- Author Info -->
							<div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-200">
								<?php if ( has_post_thumbnail() ) : ?>
								<div class="flex-shrink-0">
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-14 h-14 rounded-full object-cover border-4 border-white shadow-md' ) ); ?>
								</div>
								<?php endif; ?>

								<div class="flex-grow">
									<?php if ( $parent_name ) : ?>
									<p class="font-heading font-semibold text-gray-900"><?php echo esc_html( $parent_name ); ?></p>
									<?php endif; ?>

									<?php if ( $year ) : ?>
									<p class="text-sm text-gray-600"><?php echo esc_html( $year ); ?></p>
									<?php endif; ?>
								</div>

								<!-- Small Quote Icon for Mobile -->
								<div class="flex-shrink-0 md:hidden">
									<svg class="w-8 h-8 text-brand-blue opacity-30" fill="currentColor" viewBox="0 0 24 24">
										<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
									</svg>
								</div>
							</div>
						</div>

					<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>

				<?php else : ?>

				<div class="bg-white p-12 rounded-xl shadow-md text-center max-w-2xl mx-auto">
					<svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
						<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
					</svg>
					<p class="text-gray-500 text-lg">Share your Slumber Falls experience! Contact us to add your testimonial.</p>
				</div>

				<?php endif; ?>

			</div>
		</section>

		<!-- Wave Divider: Testimonials → About -->
		<?php get_template_part( 'template-parts/components/wave-divider', null, array(
			'color'  => 'white',
			'bg'     => 'warm-100',
			'height' => 'h-12 md:h-20',
		) ); ?>

		<!-- About Preview Section -->
		<section id="about-preview" class="about-preview-section py-12 md:py-16 bg-white">
			<div class="container mx-auto px-4">
				<h2 class="text-3xl md:text-4xl font-bold text-center mb-8">About Slumber Falls</h2>
				<p class="text-center text-gray-600 max-w-3xl mx-auto">
					Placeholder for about preview content. This section will highlight the camp's history and mission.
				</p>
			</div>
		</section>

		<!-- Wave Divider: About → CTA -->
		<div class="w-full bg-white">
			<svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-brand-blue w-full h-12 md:h-20 block">
				<path d="M0,46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V120H0Z"></path>
			</svg>
		</div>

		<!-- Call-to-Action Section -->
		<section id="cta" class="cta-section py-16 md:py-20 bg-brand-blue text-white">
			<div class="container mx-auto px-4 text-center">
				<h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Join Us?</h2>
				<p class="text-lg md:text-xl mb-8">Placeholder for call-to-action content</p>
				<div class="flex flex-col sm:flex-row gap-4 justify-center">
					<a href="#" class="inline-block bg-white text-brand-blue px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
						Explore Camps
					</a>
					<a href="#" class="inline-block bg-brand-yellow text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
						Contact Us
					</a>
				</div>
			</div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
