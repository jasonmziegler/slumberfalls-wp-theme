/**
 * Camp Filters - Client-side filtering for camp archive
 *
 * @package Slumber_Falls
 */

document.addEventListener('DOMContentLoaded', function() {
	// Get filter elements
	const ageFilter = document.getElementById('age-filter');
	const typeFilter = document.getElementById('type-filter');
	const dateFrom = document.getElementById('date-from');
	const dateTo = document.getElementById('date-to');
	const resetBtn = document.getElementById('reset-filters');
	const sortSelect = document.getElementById('sort-camps');
	const filterToggle = document.getElementById('filter-toggle');
	const filterPanel = document.getElementById('filter-panel');
	const filterCountBadge = document.getElementById('filter-count');
	const resultsCount = document.getElementById('results-count');
	const campCards = document.querySelectorAll('.camp-card');
	const noResultsMessage = document.getElementById('no-results-message');
	const campGrid = document.querySelector('.grid');

	/**
	 * Update active filter count badge
	 */
	function updateFilterCount() {
		const filters = [
			ageFilter ? ageFilter.value : '',
			typeFilter ? typeFilter.value : '',
			dateFrom ? dateFrom.value : '',
			dateTo ? dateTo.value : ''
		];
		const activeCount = filters.filter(f => f !== '').length;

		if (filterCountBadge) {
			if (activeCount > 0) {
				filterCountBadge.textContent = `${activeCount} active`;
				filterCountBadge.classList.remove('hidden');
			} else {
				filterCountBadge.classList.add('hidden');
			}
		}
	}

	/**
	 * Update results count display
	 */
	function updateResultsCount() {
		if (!resultsCount) return;

		const totalCamps = campCards.length;
		const visibleCamps = document.querySelectorAll('.camp-card:not([style*="display: none"])').length;

		if (totalCamps > 0) {
			resultsCount.textContent = `Showing ${visibleCamps} of ${totalCamps} camps`;
		}
	}

	/**
	 * Smooth scroll to results grid
	 */
	function scrollToResults() {
		if (campGrid && window.innerWidth < 768) {
			campGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	/**
	 * Filter camps based on current filter selections
	 */
	function filterCamps() {
		const selectedAge = ageFilter.value;
		const selectedType = typeFilter.value;
		const fromDate = dateFrom.value;
		const toDate = dateTo.value;

		let visibleCount = 0;

		campCards.forEach(card => {
			let show = true;

			// Age Group filter - exact match
			if (selectedAge && card.dataset.ageGroup !== selectedAge) {
				show = false;
			}

			// Camp Type filter - exact match
			if (selectedType && card.dataset.campType !== selectedType) {
				show = false;
			}

			// Date Range filter - camp must fall within selected range
			if (fromDate && card.dataset.startDate < fromDate) {
				show = false;
			}
			if (toDate && card.dataset.endDate > toDate) {
				show = false;
			}

			// Show or hide the card
			card.style.display = show ? '' : 'none';
			if (show) visibleCount++;
		});

		// Handle no results message
		if (noResultsMessage) {
			if (visibleCount === 0) {
				noResultsMessage.classList.remove('hidden');
			} else {
				noResultsMessage.classList.add('hidden');
			}
		}

		// Update counts and scroll
		updateFilterCount();
		updateResultsCount();
		scrollToResults();
	}

	/**
	 * Reset all filters and show all camps
	 */
	function resetFilters() {
		ageFilter.value = '';
		typeFilter.value = '';
		dateFrom.value = '';
		dateTo.value = '';
		filterCamps();
	}

	/**
	 * Toggle mobile filter panel
	 */
	function toggleFilterPanel() {
		if (!filterPanel || !filterToggle) return;

		const isHidden = filterPanel.classList.contains('hidden');

		if (isHidden) {
			filterPanel.classList.remove('hidden');
			filterToggle.setAttribute('aria-expanded', 'true');
		} else {
			filterPanel.classList.add('hidden');
			filterToggle.setAttribute('aria-expanded', 'false');
		}
	}

	/**
	 * Sort camps based on selected sort option
	 */
	function sortCamps() {
		if (!campGrid) return;

		const sortBy = sortSelect.value;
		const camps = Array.from(campGrid.querySelectorAll('.camp-card'));

		camps.sort((a, b) => {
			if (sortBy === 'date-asc') {
				// Sort by start date ascending (upcoming dates first)
				const dateA = a.dataset.startDate || '';
				const dateB = b.dataset.startDate || '';
				return dateA.localeCompare(dateB);
			} else if (sortBy === 'price-asc') {
				// Sort by price ascending (low to high)
				const priceA = parseFloat(a.dataset.price || 0);
				const priceB = parseFloat(b.dataset.price || 0);
				return priceA - priceB;
			} else if (sortBy === 'price-desc') {
				// Sort by price descending (high to low)
				const priceA = parseFloat(a.dataset.price || 0);
				const priceB = parseFloat(b.dataset.price || 0);
				return priceB - priceA;
			}
			return 0;
		});

		// Reorder DOM elements
		camps.forEach(camp => campGrid.appendChild(camp));
	}

	// Add event listeners to filter controls
	if (ageFilter) {
		ageFilter.addEventListener('change', filterCamps);
	}
	if (typeFilter) {
		typeFilter.addEventListener('change', filterCamps);
	}
	if (dateFrom) {
		dateFrom.addEventListener('change', filterCamps);
	}
	if (dateTo) {
		dateTo.addEventListener('change', filterCamps);
	}
	if (resetBtn) {
		resetBtn.addEventListener('click', resetFilters);
	}
	if (sortSelect) {
		sortSelect.addEventListener('change', sortCamps);
	}
	if (filterToggle) {
		filterToggle.addEventListener('click', toggleFilterPanel);
	}

	// Initialize counts on page load
	updateFilterCount();
	updateResultsCount();
});
