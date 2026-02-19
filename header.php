<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Slumber_Falls
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'slumber-falls' ); ?></a>

	<header id="masthead" class="site-header sticky top-0 z-50 bg-[#558EAF] shadow-md">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-between py-4">

				<!-- Logo Section -->
				<div class="site-branding flex items-center">
					<?php
					if ( has_custom_logo() ) :
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link block" rel="home">
							<?php the_custom_logo(); ?>
						</a>
						<?php
					else :
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white text-2xl font-bold" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
						<?php
					endif;
					?>
				</div><!-- .site-branding -->

				<!-- Desktop Navigation -->
				<nav id="site-navigation" class="main-navigation hidden md:block">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'flex space-x-6',
							'fallback_cb'    => 'slumber_falls_fallback_menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->

				<!-- Mobile Menu Toggle (structure only, functionality in Story 5.7) -->
				<button class="menu-toggle md:hidden text-white p-2" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
					</svg>
				</button>

			</div>
		</div>

		<!-- Mobile Menu Overlay -->
		<div id="mobile-menu-overlay" class="mobile-menu-overlay" role="dialog" aria-modal="true" aria-label="Mobile navigation menu">
			<div class="mobile-menu-container">
				<!-- Close Button -->
				<button class="mobile-menu-close" aria-label="Close navigation menu">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>

				<!-- Mobile Navigation Links -->
				<nav class="mobile-navigation" aria-label="Mobile navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'mobile-menu',
							'container'      => false,
							'menu_class'     => 'mobile-menu-list',
							'fallback_cb'    => 'slumber_falls_mobile_fallback_menu',
						)
					);
					?>
				</nav>
			</div>
		</div><!-- #mobile-menu-overlay -->

	</header><!-- #masthead -->
