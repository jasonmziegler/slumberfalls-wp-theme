<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Slumber_Falls
 */

?>

	<footer id="colophon" class="site-footer bg-[#558EAF] text-white py-16">
		<div class="container mx-auto px-6">

			<!-- Main Footer Content - 3 Column Layout -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

				<!-- Left Section: Logo + Tagline + Contact -->
				<div class="footer-left md:col-span-1">
					<?php
					// Get footer logo from customizer
					$footer_logo_id = get_theme_mod( 'footer_logo' );
					if ( $footer_logo_id ) :
						$footer_logo_url = wp_get_attachment_image_url( $footer_logo_id, 'full' );
						$footer_logo_alt = get_post_meta( $footer_logo_id, '_wp_attachment_image_alt', true );
					?>
					<!-- Footer Logo -->
					<div class="footer-logo mb-6">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( $footer_logo_url ); ?>" alt="<?php echo esc_attr( $footer_logo_alt ? $footer_logo_alt : get_bloginfo( 'name' ) ); ?>" class="footer-logo-img-large">
						</a>
					</div>
					<?php else : ?>
					<!-- Fallback: Site Name -->
					<h3 class="text-2xl font-bold mb-6">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white hover:text-white" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h3>
					<?php endif; ?>

					<!-- Contact Info -->
					<div class="footer-contact space-y-3 text-base leading-relaxed">
						<h4 class="text-xl font-bold mb-4"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4>
						<p>
							3610 River Road, New Braunfels, TX 78132
						</p>
						<p>
							<a href="tel:+18306252212" class="footer-link">(830) 625-2212</a> &nbsp;
							<a href="mailto:office@slumberfalls.org" class="footer-link">office@slumberfalls.org</a>
						</p>
						<p class="text-sm">
							Office Hours: Tuesday - Friday, 9am - 1pm or by appointment
						</p>
						<p class="font-bold text-lg pt-4">
							Building campfires and community since 1958
						</p>
					</div>
				</div>

				<!-- Center Section: Quick Links -->
				<div class="footer-links md:col-span-1">
					<ul class="space-y-3 text-base">
						<li><a href="<?php echo esc_url( home_url( '/camps/' ) ); ?>" class="footer-link">Summer Camp</a></li>
						<li><a href="<?php echo esc_url( home_url( '/facilities/' ) ); ?>" class="footer-link">Facilities</a></li>
						<li><a href="<?php echo esc_url( home_url( '/join-our-team/' ) ); ?>" class="footer-link">Join Our Team</a></li>
						<li><a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="footer-link">Support SFC</a></li>
						<li><a href="<?php echo esc_url( home_url( '/meet-the-board/' ) ); ?>" class="footer-link">Meet the Board</a></li>
						<li><a href="https://www.dshs.texas.gov/youth-camps" target="_blank" rel="noopener noreferrer" class="footer-link">TX Dept of State Health Services Youth Camp Complaint Form</a></li>
					</ul>
				</div>

				<!-- Right Section: Social Media -->
				<div class="footer-social md:col-span-1">
					<h3 class="text-xl font-bold mb-6">Follow</h3>
					<ul class="space-y-3 text-base">
						<li>
							<a href="#" class="footer-link flex items-center gap-2">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
								</svg>
								Facebook
							</a>
						</li>
						<li>
							<a href="#" class="footer-link flex items-center gap-2">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
								</svg>
								Instagram
							</a>
						</li>
						<li>
							<a href="#" class="footer-link flex items-center gap-2">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
								</svg>
								TikTok
							</a>
						</li>
					</ul>
				</div>

			</div>

			<!-- Copyright Row -->
			<div class="border-t border-white border-opacity-30 pt-6 text-center text-sm">
				<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Slumber Falls Camp. All rights reserved.</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( ! is_front_page() ) : ?>
	<!-- Sticky CTAs (hidden on homepage) -->

	<!-- Desktop Sticky CTA -->
	<div id="sticky-cta-desktop" class="sticky-cta-desktop hidden">
		<button class="close-cta" aria-label="Close sticky button">
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
			</svg>
		</button>
		<a href="<?php echo esc_url( home_url( '/camps/' ) ); ?>" class="cta-button">
			Register Now
		</a>
	</div>

	<!-- Mobile Sticky CTA Bar -->
	<div id="sticky-cta-mobile" class="sticky-cta-mobile hidden">
		<button class="close-cta-mobile" aria-label="Close sticky bar">
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
			</svg>
		</button>
		<div class="cta-buttons">
			<a href="<?php echo esc_url( home_url( '/camps/' ) ); ?>" class="cta-register">
				Register
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="cta-inquire">
				Inquire
			</a>
		</div>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
