<?php
/**
 * The template for displaying a single Camp
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
				<a href="<?php echo esc_url( get_post_type_archive_link( 'camp' ) ); ?>" class="text-brand-blue hover:underline">
					<?php esc_html_e( 'Camps', 'slumber-falls' ); ?>
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
		// Get camp meta data.
		$start_date = get_post_meta( get_the_ID(), 'camp_start_date', true );
		$end_date   = get_post_meta( get_the_ID(), 'camp_end_date', true );
		$age_group  = get_post_meta( get_the_ID(), 'camp_age_group', true );
		$price      = get_post_meta( get_the_ID(), 'camp_price', true );
		$camp_type  = get_post_meta( get_the_ID(), 'camp_type', true );

		// Format camp type for display.
		$camp_type_labels = array(
			'overnight' => __( 'Overnight Camp', 'slumber-falls' ),
			'day_camp'  => __( 'Day Camp', 'slumber-falls' ),
			'retreat'   => __( 'Retreat', 'slumber-falls' ),
		);
		$camp_type_display = isset( $camp_type_labels[ $camp_type ] ) ? $camp_type_labels[ $camp_type ] : '';
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto py-8 px-4' ); ?>>
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="camp-featured-image mb-8 rounded-lg overflow-hidden shadow-lg">
					<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
				</div>
			<?php endif; ?>

			<!-- Camp Header -->
			<header class="camp-header mb-8">
				<h1 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">
					<?php the_title(); ?>
				</h1>

				<!-- Camp Type Badge -->
				<?php if ( $camp_type_display ) : ?>
					<span class="inline-block px-3 py-1 rounded-full text-sm font-medium
						<?php
						switch ( $camp_type ) {
							case 'overnight':
								echo 'bg-brand-blue text-white';
								break;
							case 'day_camp':
								echo 'bg-brand-yellow text-black';
								break;
							case 'retreat':
								echo 'bg-brand-green text-white';
								break;
							default:
								echo 'bg-gray-200 text-gray-700';
						}
						?>
					">
						<?php echo esc_html( $camp_type_display ); ?>
					</span>
				<?php endif; ?>
			</header>

			<!-- Camp Details Grid -->
			<div class="camp-details grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-6 bg-gray-50 rounded-lg">
				<!-- Dates -->
				<?php if ( $start_date && $end_date ) : ?>
					<div class="detail-item">
						<span class="block text-sm text-gray-500 uppercase tracking-wide mb-1">
							<?php esc_html_e( 'Dates', 'slumber-falls' ); ?>
						</span>
						<span class="text-lg font-semibold text-gray-900">
							<?php
							echo esc_html( date_i18n( 'M j', strtotime( $start_date ) ) );
							echo ' - ';
							echo esc_html( date_i18n( 'M j, Y', strtotime( $end_date ) ) );
							?>
						</span>
					</div>
				<?php endif; ?>

				<!-- Age Group -->
				<?php if ( $age_group ) : ?>
					<div class="detail-item">
						<span class="block text-sm text-gray-500 uppercase tracking-wide mb-1">
							<?php esc_html_e( 'Age Group', 'slumber-falls' ); ?>
						</span>
						<span class="text-lg font-semibold text-gray-900">
							<?php echo esc_html( $age_group ); ?>
						</span>
					</div>
				<?php endif; ?>

				<!-- Price -->
				<?php if ( $price ) : ?>
					<div class="detail-item">
						<span class="block text-sm text-gray-500 uppercase tracking-wide mb-1">
							<?php esc_html_e( 'Price', 'slumber-falls' ); ?>
						</span>
						<span class="text-2xl font-bold text-brand-green">
							<?php echo esc_html( $price ); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>

			<!-- Register Now CTA -->
			<div class="camp-cta mb-8">
				<a href="#"
				   class="inline-block bg-brand-blue hover:bg-brand-blue-600 text-white font-bold py-4 px-8 rounded-lg text-lg transition-colors shadow-md hover:shadow-lg">
					<?php esc_html_e( 'Register Now', 'slumber-falls' ); ?>
				</a>
				<p class="text-sm text-gray-500 mt-2">
					<?php esc_html_e( 'Registration opens in a new window', 'slumber-falls' ); ?>
				</p>
			</div>

			<!-- Camp Description -->
			<div class="camp-description prose prose-lg max-w-none">
				<h2 class="text-2xl font-bold text-gray-900 mb-4">
					<?php esc_html_e( 'About This Camp', 'slumber-falls' ); ?>
				</h2>
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile; ?>
</main><!-- #main -->

<?php
get_footer();
