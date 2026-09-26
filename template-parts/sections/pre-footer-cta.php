<?php
/**
 * Pre-Footer CTA Section
 *
 * Reusable call-to-action section displayed above the footer on all inner pages.
 *
 * Content priority:
 *   1. Per-post meta (set in the page/post editor)
 *   2. $args passed to get_template_part() (per-template defaults)
 *   3. Customizer settings (site-wide defaults)
 *
 * @package Slumber_Falls
 *
 * @param string $args['wave_from']   Tailwind bg-color key of the section above. Default 'white'.
 *                                    Accepted: 'white', 'gray-50', 'warm-50', 'warm-100'.
 * @param string $args['heading']     Template-level heading override (before meta check).
 * @param string $args['subtext']     Template-level subtext override.
 * @param string $args['btn1_label']  Template-level button 1 label override.
 * @param string $args['btn1_url']    Template-level button 1 URL override.
 * @param string $args['btn2_label']  Template-level button 2 label override.
 * @param string $args['btn2_url']    Template-level button 2 URL override.
 */

// -- 1. Check if hidden via page meta -----------------------------------------
if ( is_singular() ) {
	$post_id = get_the_ID();
	if ( get_post_meta( $post_id, 'pre_footer_cta_hide', true ) ) {
		return;
	}
}

// -- 2. Build content: meta → $args → Customizer defaults ---------------------

/**
 * Helper: resolve a field value from meta → $args → Customizer.
 *
 * @param string $key      Meta key / $args key / Customizer setting key.
 * @param string $fallback Hard-coded fallback if nothing is set anywhere.
 */
$resolve = function( $key, $fallback ) use ( $args ) {
	// Page/post meta (only on singular pages).
	if ( is_singular() ) {
		$meta = get_post_meta( get_the_ID(), $key, true );
		if ( ! empty( $meta ) ) {
			return $meta;
		}
	}
	// Template-level $args override.
	if ( ! empty( $args[ $key ] ) ) {
		return $args[ $key ];
	}
	// Customizer setting.
	$customizer = get_theme_mod( $key, '' );
	if ( ! empty( $customizer ) ) {
		return $customizer;
	}
	return $fallback;
};

$heading    = $resolve( 'pre_footer_cta_heading',   __( 'Ready to Join Us?', 'slumber-falls' ) );
$subtext    = $resolve( 'pre_footer_cta_subtext',   __( 'Experience 68+ years of faith-based adventure at Slumber Falls Camp.', 'slumber-falls' ) );
$btn1_label = $resolve( 'pre_footer_cta_btn1_label', __( 'Explore Camps', 'slumber-falls' ) );
$btn1_url   = $resolve( 'pre_footer_cta_btn1_url',  home_url( '/camps/' ) );
$btn2_label = $resolve( 'pre_footer_cta_btn2_label', __( 'Contact Us', 'slumber-falls' ) );
$btn2_url   = $resolve( 'pre_footer_cta_btn2_url',  home_url( '/contact/' ) );

// -- 3. Wave background (must match the section above) ------------------------
$wave_from       = $args['wave_from'] ?? 'white';
$wave_bg_classes = array(
	'white'    => 'bg-white',
	'gray-50'  => 'bg-gray-50',
	'warm-50'  => 'bg-warm-50',
	'warm-100' => 'bg-warm-100',
);
$wave_bg_class = $wave_bg_classes[ $wave_from ] ?? 'bg-white';
?>

<!-- Wave Divider: Content → Pre-Footer CTA -->
<div class="w-full <?php echo esc_attr( $wave_bg_class ); ?>">
	<svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-brand-blue w-full h-12 md:h-20 block">
		<path d="M0,46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V120H0Z"></path>
	</svg>
</div>

<!-- Pre-Footer CTA Section -->
<section class="pre-footer-cta py-16 md:py-20 bg-brand-blue text-white">
	<div class="container mx-auto px-4 text-center">
		<h2 class="font-heading text-3xl md:text-4xl font-bold mb-4">
			<?php echo esc_html( $heading ); ?>
		</h2>

		<?php if ( $subtext ) : ?>
		<p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto opacity-90">
			<?php echo esc_html( $subtext ); ?>
		</p>
		<?php endif; ?>

		<div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
			<?php if ( $btn1_label && $btn1_url ) : ?>
			<a href="<?php echo esc_url( $btn1_url ); ?>"
			   class="inline-block bg-white text-brand-blue font-heading font-semibold px-8 py-3 rounded-full shadow-button hover:shadow-button-hover hover:bg-gray-100 transition-all duration-300 min-h-[44px] text-center">
				<?php echo esc_html( $btn1_label ); ?>
			</a>
			<?php endif; ?>

			<?php if ( $btn2_label && $btn2_url ) : ?>
			<a href="<?php echo esc_url( $btn2_url ); ?>"
			   class="inline-block bg-brand-yellow hover:bg-accent-gold-500 text-gray-900 font-heading font-semibold px-8 py-3 rounded-full shadow-button hover:shadow-button-hover transition-all duration-300 min-h-[44px] text-center">
				<?php echo esc_html( $btn2_label ); ?>
			</a>
			<?php endif; ?>
		</div>
	</div>
</section>
