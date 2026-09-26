<?php
/**
 * Wave Divider Component
 *
 * Reusable SVG wave transition between page sections.
 *
 * @param string $color    Tailwind color suffix for wave fill (e.g. 'white', 'warm-50'). Default: 'white'.
 * @param string $bg       Tailwind color suffix for wrapper background (matches section above). Default: '' (no bg class).
 * @param string $height   Tailwind height classes. Default: 'h-12 md:h-20'.
 * @param bool   $inverted Rotate wave 180deg. Default: false.
 *
 * @package Slumber_Falls
 */

/*
 * Tailwind safeguard — classes used dynamically below (do not remove):
 * text-white text-warm-50 text-warm-100 text-warm-200 text-warm-300
 * text-brand-blue text-brand-blue-800 text-brand-blue-900
 * bg-white bg-warm-50 bg-warm-100 bg-warm-200 bg-warm-300
 * bg-brand-blue bg-brand-blue-800 bg-brand-blue-900
 */

$color    = isset( $args['color'] ) ? $args['color'] : 'white';
$bg       = isset( $args['bg'] ) ? $args['bg'] : '';
$height   = isset( $args['height'] ) ? $args['height'] : 'h-12 md:h-20';
$inverted = isset( $args['inverted'] ) ? $args['inverted'] : false;

$rotation  = $inverted ? 'rotate-180' : '';
$bg_class  = $bg ? 'bg-' . esc_attr( $bg ) : 'relative -mb-1';
?>

<div class="w-full <?php echo $bg_class; ?>">
	<svg viewBox="0 0 1200 120"
		preserveAspectRatio="none"
		class="fill-current text-<?php echo esc_attr( $color ); ?> w-full <?php echo esc_attr( $height ); ?> block <?php echo esc_attr( $rotation ); ?>">
		<path d="M0,46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V120H0Z"></path>
	</svg>
</div>
