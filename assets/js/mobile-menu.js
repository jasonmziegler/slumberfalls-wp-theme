/**
 * Mobile Menu Toggle Functionality
 *
 * Handles opening/closing mobile menu overlay with accessibility support
 */
(function() {
	'use strict';

	// Get DOM elements
	const menuToggle = document.querySelector('.menu-toggle');
	const mobileOverlay = document.getElementById('mobile-menu-overlay');
	const closeButton = document.querySelector('.mobile-menu-close');
	const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');

	// Early return if elements don't exist
	if (!menuToggle || !mobileOverlay || !closeButton) {
		return;
	}

	/**
	 * Open mobile menu
	 */
	function openMenu() {
		mobileOverlay.classList.add('is-open');
		menuToggle.setAttribute('aria-expanded', 'true');
		document.body.style.overflow = 'hidden'; // Prevent body scroll

		// Focus on close button for accessibility
		closeButton.focus();
	}

	/**
	 * Close mobile menu
	 */
	function closeMenu() {
		mobileOverlay.classList.remove('is-open');
		menuToggle.setAttribute('aria-expanded', 'false');
		document.body.style.overflow = ''; // Re-enable body scroll

		// Return focus to toggle button
		menuToggle.focus();
	}

	/**
	 * Toggle menu open/close
	 */
	function toggleMenu() {
		if (mobileOverlay.classList.contains('is-open')) {
			closeMenu();
		} else {
			openMenu();
		}
	}

	// Event Listeners

	// Hamburger button click
	menuToggle.addEventListener('click', function(e) {
		e.preventDefault();
		toggleMenu();
	});

	// Close button click
	closeButton.addEventListener('click', function(e) {
		e.preventDefault();
		closeMenu();
	});

	// Click outside menu to close (click on overlay background)
	mobileOverlay.addEventListener('click', function(e) {
		// Only close if clicking the overlay itself, not the menu container
		if (e.target === mobileOverlay) {
			closeMenu();
		}
	});

	// Close menu when clicking a navigation link
	mobileMenuLinks.forEach(function(link) {
		link.addEventListener('click', function() {
			closeMenu();
		});
	});

	// Close menu on Escape key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && mobileOverlay.classList.contains('is-open')) {
			closeMenu();
		}
	});

	// Focus trap - keep focus within menu when open
	document.addEventListener('keydown', function(e) {
		if (!mobileOverlay.classList.contains('is-open')) {
			return;
		}

		// Tab key handling for focus trap
		if (e.key === 'Tab') {
			const focusableElements = mobileOverlay.querySelectorAll(
				'button, a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
			);

			const firstElement = focusableElements[0];
			const lastElement = focusableElements[focusableElements.length - 1];

			// Shift + Tab (backwards)
			if (e.shiftKey) {
				if (document.activeElement === firstElement) {
					e.preventDefault();
					lastElement.focus();
				}
			} else {
				// Tab (forwards)
				if (document.activeElement === lastElement) {
					e.preventDefault();
					firstElement.focus();
				}
			}
		}
	});

})();
