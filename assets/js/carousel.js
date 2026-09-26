/**
 * Featured Camps Carousel
 * Vanilla JavaScript carousel with touch support
 */

(function() {
	'use strict';

	const carousel = document.getElementById('campsCarousel');
	const prevBtn = document.getElementById('prevSlide');
	const nextBtn = document.getElementById('nextSlide');
	const dots = document.querySelectorAll('.carousel-dot');

	if (!carousel) return;

	const slides = carousel.querySelectorAll('.carousel-slide');
	const totalSlides = slides.length;
	let currentSlide = 0;
	let autoplayInterval = null;
	let touchStartX = 0;
	let touchEndX = 0;

	/**
	 * Go to specific slide
	 */
	function goToSlide(index) {
		if (index < 0) index = totalSlides - 1;
		if (index >= totalSlides) index = 0;

		currentSlide = index;

		// Scroll to slide
		const slideWidth = slides[0].offsetWidth;
		carousel.scrollTo({
			left: slideWidth * currentSlide,
			behavior: 'smooth'
		});

		// Update dots
		updateDots();
	}

	/**
	 * Update dot indicators
	 */
	function updateDots() {
		dots.forEach((dot, index) => {
			if (index === currentSlide) {
				dot.classList.remove('bg-gray-300', 'hover:bg-gray-400', 'w-3');
				dot.classList.add('bg-brand-blue', 'w-8');
			} else {
				dot.classList.remove('bg-brand-blue', 'w-8');
				dot.classList.add('bg-gray-300', 'hover:bg-gray-400', 'w-3');
			}
		});
	}

	/**
	 * Next slide
	 */
	function nextSlide() {
		goToSlide(currentSlide + 1);
	}

	/**
	 * Previous slide
	 */
	function prevSlide() {
		goToSlide(currentSlide - 1);
	}

	/**
	 * Start autoplay
	 */
	function startAutoplay() {
		if (totalSlides <= 1) return;

		autoplayInterval = setInterval(() => {
			nextSlide();
		}, 5000); // 5 seconds
	}

	/**
	 * Stop autoplay
	 */
	function stopAutoplay() {
		if (autoplayInterval) {
			clearInterval(autoplayInterval);
			autoplayInterval = null;
		}
	}

	/**
	 * Handle touch start
	 */
	function handleTouchStart(e) {
		touchStartX = e.changedTouches[0].screenX;
	}

	/**
	 * Handle touch end
	 */
	function handleTouchEnd(e) {
		touchEndX = e.changedTouches[0].screenX;
		handleSwipe();
	}

	/**
	 * Handle swipe gesture
	 */
	function handleSwipe() {
		const swipeThreshold = 50; // Minimum swipe distance

		if (touchEndX < touchStartX - swipeThreshold) {
			// Swipe left - next slide
			nextSlide();
		}

		if (touchEndX > touchStartX + swipeThreshold) {
			// Swipe right - previous slide
			prevSlide();
		}
	}

	// Event listeners for arrow buttons
	if (prevBtn) {
		prevBtn.addEventListener('click', prevSlide);
	}

	if (nextBtn) {
		nextBtn.addEventListener('click', nextSlide);
	}

	// Event listeners for dot indicators
	dots.forEach((dot) => {
		dot.addEventListener('click', function() {
			const slideIndex = parseInt(this.getAttribute('data-slide'));
			goToSlide(slideIndex);
		});
	});

	// Touch event listeners for swipe
	carousel.addEventListener('touchstart', handleTouchStart, false);
	carousel.addEventListener('touchend', handleTouchEnd, false);

	// Pause autoplay on hover
	carousel.addEventListener('mouseenter', stopAutoplay);
	carousel.addEventListener('mouseleave', startAutoplay);

	// Pause autoplay on touch
	carousel.addEventListener('touchstart', stopAutoplay);

	// Start autoplay on load
	startAutoplay();

	// Handle browser back/forward
	window.addEventListener('popstate', function() {
		goToSlide(0);
	});

})();
