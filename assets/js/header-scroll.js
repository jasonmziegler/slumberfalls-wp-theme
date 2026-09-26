/**
 * Header Scroll Effect
 *
 * Adds/removes the 'header-scrolled' class on the site header based on scroll position.
 * Uses requestAnimationFrame for smooth 60fps performance.
 * Uses passive event listener to allow browser scroll optimizations.
 *
 * @package Slumber_Falls
 */

( function () {
	var header = document.querySelector( '.site-header' );

	if ( ! header ) {
		return;
	}

	var ticking = false;

	function updateHeader() {
		if ( window.scrollY > 50 ) {
			header.classList.add( 'header-scrolled' );
		} else {
			header.classList.remove( 'header-scrolled' );
		}
		ticking = false;
	}

	function handleScroll() {
		if ( ! ticking ) {
			window.requestAnimationFrame( updateHeader );
			ticking = true;
		}
	}

	window.addEventListener( 'scroll', handleScroll, { passive: true } );
} )();
