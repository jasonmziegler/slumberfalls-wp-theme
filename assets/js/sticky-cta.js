/**
 * Sticky CTA Functionality
 *
 * Handles scroll detection and display of sticky CTAs on desktop and mobile
 */
(function() {
	'use strict';

	// Configuration
	const SCROLL_THRESHOLD = 200; // Show CTAs after 200px scroll
	const SESSION_KEY = 'slumber_falls_sticky_cta_hidden';

	// Get DOM elements
	const desktopCta = document.getElementById('sticky-cta-desktop');
	const mobileCta = document.getElementById('sticky-cta-mobile');
	const closeButtonDesktop = document.querySelector('.close-cta');
	const closeButtonMobile = document.querySelector('.close-cta-mobile');

	// Early return if elements don't exist (homepage or missing elements)
	if (!desktopCta || !mobileCta) {
		return;
	}

	// Check if user has hidden CTAs this session
	const ctaHidden = sessionStorage.getItem(SESSION_KEY) === 'true';

	if (ctaHidden) {
		// User closed CTAs this session, keep them hidden
		return;
	}

	/**
	 * Show sticky CTAs
	 */
	function showCtas() {
		desktopCta.classList.remove('hidden');
		desktopCta.classList.add('visible');
		mobileCta.classList.remove('hidden');
		mobileCta.classList.add('visible');
	}

	/**
	 * Hide sticky CTAs
	 */
	function hideCtas() {
		desktopCta.classList.remove('visible');
		desktopCta.classList.add('hidden');
		mobileCta.classList.remove('visible');
		mobileCta.classList.add('hidden');
	}

	/**
	 * Handle scroll event
	 */
	function handleScroll() {
		const scrollPosition = window.scrollY || window.pageYOffset;

		if (scrollPosition > SCROLL_THRESHOLD) {
			showCtas();
		} else {
			hideCtas();
		}
	}

	/**
	 * Close CTAs and save preference for session
	 */
	function closeCtas(e) {
		e.preventDefault();
		hideCtas();
		sessionStorage.setItem(SESSION_KEY, 'true');

		// Remove scroll listener since user closed CTAs
		window.removeEventListener('scroll', handleScroll);
	}

	// Event Listeners

	// Scroll event with throttling for performance
	let scrollTimeout;
	window.addEventListener('scroll', function() {
		if (scrollTimeout) {
			return;
		}

		scrollTimeout = setTimeout(function() {
			handleScroll();
			scrollTimeout = null;
		}, 100); // Throttle to every 100ms
	});

	// Close button events
	if (closeButtonDesktop) {
		closeButtonDesktop.addEventListener('click', closeCtas);
	}

	if (closeButtonMobile) {
		closeButtonMobile.addEventListener('click', closeCtas);
	}

	// Initial check on page load
	handleScroll();

})();
