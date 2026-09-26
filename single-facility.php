<?php
/**
 * The template for displaying a single Facility
 *
 * @package Slumber_Falls
 */

get_header();
?>

<nav class="breadcrumb bg-gray-100 py-3 px-4" aria-label="<?php esc_attr_e( 'Breadcrumb', 'slumber-falls' ); ?>">
	<div class="max-w-4xl mx-auto">
		<ol class="flex items-center space-x-2 text-sm">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-brand-brown hover:underline">
					<?php esc_html_e( 'Home', 'slumber-falls' ); ?>
				</a>
			</li>
			<li>
				<span class="text-gray-400 mx-2">&gt;</span>
			</li>
			<li>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'facility' ) ); ?>" class="text-brand-brown hover:underline">
					<?php esc_html_e( 'Facilities', 'slumber-falls' ); ?>
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
		// Get facility meta data.
		$capacity  = get_post_meta( get_the_ID(), 'facility_capacity', true );
		$amenities = get_post_meta( get_the_ID(), 'facility_amenities', true );
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto py-8 px-4' ); ?>>
			<!-- Facility Header -->
			<header class="facility-header mb-8">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="facility-featured-image mb-6">
						<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg shadow-lg' ) ); ?>
					</div>
				<?php endif; ?>

				<h1 class="text-3xl md:text-4xl font-bold text-brand-brown mb-4">
					<?php the_title(); ?>
				</h1>

				<?php if ( $capacity ) : ?>
					<div class="capacity-info bg-blue-50 border-l-4 border-brand-blue p-4 mb-6">
						<p class="text-lg">
							<strong class="text-brand-blue"><?php esc_html_e( 'Capacity:', 'slumber-falls' ); ?></strong>
							<span class="text-gray-900 font-semibold"><?php echo esc_html( $capacity ); ?></span>
						</p>
					</div>
				<?php endif; ?>
			</header>

			<!-- Facility Description -->
			<div class="facility-description prose prose-lg max-w-none mb-8">
				<?php the_content(); ?>
			</div>

			<!-- Amenities List -->
			<?php if ( ! empty( $amenities ) ) : ?>
				<div class="facility-amenities bg-gray-50 rounded-lg p-6 mb-8">
					<h2 class="text-2xl font-bold text-brand-brown mb-4">
						<?php esc_html_e( 'Amenities & Features', 'slumber-falls' ); ?>
					</h2>
					<ul class="space-y-2 text-gray-700">
						<?php
						// Try splitting by line breaks first.
						$items = preg_split( '/\r\n|\r|\n/', $amenities );

						// If single line, split by commas.
						if ( count( $items ) === 1 ) {
							$items = explode( ',', $amenities );
						}

						foreach ( $items as $item ) {
							$item = trim( $item );
							if ( ! empty( $item ) ) {
								echo '<li class="flex items-start">';
								echo '<svg class="w-5 h-5 text-brand-blue mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';
								echo '<span>' . esc_html( $item ) . '</span>';
								echo '</li>';
							}
						}
						?>
					</ul>
				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>
</main><!-- #main -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array(
	'wave_from'                  => 'white',
	'pre_footer_cta_btn1_label'  => __( 'Plan a Retreat', 'slumber-falls' ),
	'pre_footer_cta_btn1_url'    => home_url( '/retreats/' ),
) ); ?>

<?php
get_footer();
