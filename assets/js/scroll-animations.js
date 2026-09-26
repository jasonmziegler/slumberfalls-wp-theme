/**
 * Scroll Animations
 *
 * Intersection Observer based animation system.
 * Triggers CSS animations when elements scroll into view.
 * Supports data-animate for individual elements and data-stagger for groups.
 * Respects prefers-reduced-motion accessibility preference.
 *
 * @package Slumber_Falls
 */

document.addEventListener( 'DOMContentLoaded', function () {

	// Respect prefers-reduced-motion accessibility setting
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}

	var observerOptions = {
		threshold: 0.1,
		rootMargin: '0px 0px -50px 0px',
	};

	// Observer for individual (non-stagger) animated elements
	var observer = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				entry.target.classList.remove( 'sf-scroll-hidden' );
				entry.target.classList.add( 'animate-' + entry.target.dataset.animate );
				observer.unobserve( entry.target );
			}
		} );
	}, observerOptions );

	// Observe all elements with data-animate that are NOT inside a stagger container
	document.querySelectorAll( '[data-animate]' ).forEach( function ( el ) {
		if ( ! el.closest( '[data-stagger]' ) ) {
			el.classList.add( 'sf-scroll-hidden' );
			observer.observe( el );
		}
	} );

	// Handle stagger containers
	document.querySelectorAll( '[data-stagger]' ).forEach( function ( container ) {
		var items = container.querySelectorAll( '[data-animate]' );

		// Hide all stagger children initially
		items.forEach( function ( item ) {
			item.classList.add( 'sf-scroll-hidden' );
		} );

		// Observe the container; animate children with incremental delay when visible
		var staggerObserver = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					items.forEach( function ( item, index ) {
						item.style.animationDelay = ( index * 0.15 ) + 's';
						item.classList.remove( 'sf-scroll-hidden' );
						item.classList.add( 'animate-' + item.dataset.animate );
					} );
					staggerObserver.unobserve( entry.target );
				}
			} );
		}, observerOptions );

		staggerObserver.observe( container );
	} );

} );
