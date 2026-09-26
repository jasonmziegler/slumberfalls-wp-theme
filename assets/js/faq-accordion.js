/**
 * FAQ Accordion functionality
 * Handles category and FAQ expand/collapse with accessibility support
 *
 * @package Slumber_Falls
 */

document.addEventListener('DOMContentLoaded', function() {
	// Category Accordion Logic
	const categoryTriggers = document.querySelectorAll('.category-trigger');

	categoryTriggers.forEach(function(trigger) {
		trigger.addEventListener('click', function() {
			const content = document.getElementById(trigger.getAttribute('aria-controls'));
			const icon = trigger.querySelector('.category-icon');
			const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

			// Close all other categories
			categoryTriggers.forEach(function(otherTrigger) {
				if (otherTrigger !== trigger) {
					const otherContent = document.getElementById(otherTrigger.getAttribute('aria-controls'));
					const otherIcon = otherTrigger.querySelector('.category-icon');

					otherTrigger.setAttribute('aria-expanded', 'false');
					otherContent.setAttribute('aria-hidden', 'true');
					otherContent.style.maxHeight = '0';
					otherIcon.style.transform = 'rotate(0deg)';
				}
			});

			// Toggle current category
			if (isExpanded) {
				trigger.setAttribute('aria-expanded', 'false');
				content.setAttribute('aria-hidden', 'true');
				content.style.maxHeight = '0';
				icon.style.transform = 'rotate(0deg)';
			} else {
				trigger.setAttribute('aria-expanded', 'true');
				content.setAttribute('aria-hidden', 'false');
				content.style.maxHeight = '5000px'; // Large enough for content
				icon.style.transform = 'rotate(180deg)';
			}
		});

		// Keyboard support (Enter and Space)
		trigger.addEventListener('keydown', function(e) {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				trigger.click();
			}
		});
	});

	// FAQ Accordion Logic
	const faqTriggers = document.querySelectorAll('.faq-trigger');

	faqTriggers.forEach(function(trigger) {
		trigger.addEventListener('click', function() {
			const content = document.getElementById(trigger.getAttribute('aria-controls'));
			const icon = trigger.querySelector('.faq-icon');
			const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

			// Toggle FAQ
			if (isExpanded) {
				trigger.setAttribute('aria-expanded', 'false');
				content.setAttribute('aria-hidden', 'true');
				content.style.maxHeight = '0';
				icon.style.transform = 'rotate(0deg)';
			} else {
				trigger.setAttribute('aria-expanded', 'true');
				content.setAttribute('aria-hidden', 'false');
				// Calculate actual content height for smooth animation
				content.style.maxHeight = content.scrollHeight + 'px';
				icon.style.transform = 'rotate(180deg)';
			}
		});

		// Keyboard support (Enter and Space)
		trigger.addEventListener('keydown', function(e) {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				trigger.click();
			}
		});
	});

	// Initialize first category as open
	if (categoryTriggers.length > 0) {
		const firstIcon = categoryTriggers[0].querySelector('.category-icon');
		if (firstIcon) {
			firstIcon.style.transform = 'rotate(180deg)';
		}
	}
});
