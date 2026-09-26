# Sticky CTA Test Checklist - Story 5.8

## Test Date: 2026-02-19

## Desktop Sticky CTA Tests (AC: 1)

### Button Appearance
- [ ] Floating button appears in bottom-right corner
- [ ] Button text reads "Register Now"
- [ ] Button styled with brand blue (#558EAF)
- [ ] Button has rounded corners (pill shape)
- [ ] Button has shadow for depth
- [ ] Close button (X) visible in top-right of CTA

### Positioning
- [ ] Position: fixed bottom-right (2rem from edges)
- [ ] Z-index keeps button above content
- [ ] Does not interfere with page content
- [ ] Visible across different screen sizes (desktop only)

### Functionality
- [ ] Click "Register Now" → navigates to `/camps/`
- [ ] Hover state shows darker blue
- [ ] Hover lifts button slightly (transform)
- [ ] Close button (X) hides CTA when clicked
- [ ] CTA stays hidden for session after closing

## Mobile Sticky CTA Bar Tests (AC: 1)

### Bar Appearance
- [ ] Fixed bar appears at bottom of screen
- [ ] White background with shadow
- [ ] Contains two buttons: "Register" and "Inquire"
- [ ] "Register" button is blue (#558EAF)
- [ ] "Inquire" button is yellow (#E3B82B)
- [ ] Close button (X) visible in top-right corner

### Button Layout
- [ ] Two buttons side-by-side
- [ ] Equal width (flex: 1)
- [ ] Adequate padding for tap targets
- [ ] Gap between buttons (0.75rem)
- [ ] Text centered in buttons

### Functionality
- [ ] Click "Register" → navigates to `/camps/`
- [ ] Click "Inquire" → navigates to `/contact/`
- [ ] Hover/tap shows visual feedback (lift effect)
- [ ] Close button (X) hides bar when clicked
- [ ] Bar stays hidden for session after closing

## Scroll Detection Tests (AC: 2)

### Initial State (Top of Page)
- [ ] CTAs hidden when page first loads
- [ ] CTAs hidden when scrollY < 200px
- [ ] No CTAs visible at very top of page

### After Scrolling Down
- [ ] Desktop CTA appears after scrolling 200px down
- [ ] Mobile CTA bar appears after scrolling 200px down
- [ ] Smooth fade-in transition (opacity + transform)
- [ ] CTAs remain visible while scrolled down

### Scrolling Back Up
- [ ] CTAs disappear when scrolling back to top (<200px)
- [ ] Smooth fade-out transition
- [ ] CTAs hidden when at top of page

### Scroll Performance
- [ ] Scroll detection throttled (no lag/jank)
- [ ] Smooth scrolling performance
- [ ] No excessive CPU usage during scroll

## Styling Tests (AC: 3)

### Desktop Button Colors
- [ ] Background: #558EAF (brand blue)
- [ ] Text: white
- [ ] Hover: darker blue (#467396)
- [ ] Shadow: 0 10px 25px rgba(85, 142, 175, 0.4)

### Mobile Button Colors
- [ ] Register button: #558EAF (blue)
- [ ] Inquire button: #E3B82B (yellow)
- [ ] Bar background: white
- [ ] Bar shadow: 0 -4px 20px rgba(0, 0, 0, 0.15)

### Z-Index
- [ ] Desktop CTA: z-index 40
- [ ] Mobile CTA: z-index 40
- [ ] CTAs float above all page content
- [ ] No content covers CTAs

## Close Button Tests (AC: 4)

### Desktop Close Button
- [ ] Small X icon visible
- [ ] Positioned top-right of button
- [ ] White background with blue border
- [ ] Click hides desktop CTA
- [ ] Preference stored in sessionStorage

### Mobile Close Button
- [ ] Small X icon visible
- [ ] Positioned top-right of bar
- [ ] Click hides mobile CTA bar
- [ ] Preference stored in sessionStorage

### SessionStorage
- [ ] Key: `slumber_falls_sticky_cta_hidden`
- [ ] Value: `true` when closed
- [ ] CTAs stay hidden for session duration
- [ ] CTAs reappear after closing/reopening browser
- [ ] Session preference works independently per tab

## Homepage Exclusion Tests

### Homepage
- [ ] No sticky CTAs on homepage
- [ ] Desktop CTA not present in DOM on homepage
- [ ] Mobile CTA not present in DOM on homepage
- [ ] JavaScript not loaded on homepage

### Other Pages
- [ ] Sticky CTAs appear on camp archive
- [ ] Sticky CTAs appear on single camp pages
- [ ] Sticky CTAs appear on contact page
- [ ] Sticky CTAs appear on all non-homepage pages

## Navigation Tests (AC: 5)

### Desktop CTA Navigation
- [ ] Click "Register Now"
- [ ] Browser navigates to `/camps/` page
- [ ] Correct camp archive page loads
- [ ] Navigation works from multiple pages

### Mobile CTA Navigation
- [ ] Click "Register" button
- [ ] Browser navigates to `/camps/` page
- [ ] Click "Inquire" button
- [ ] Browser navigates to `/contact/` page
- [ ] Both buttons work from multiple pages

## Responsive Tests

### Desktop (≥ 768px)
- [ ] Desktop CTA visible (when scrolled)
- [ ] Mobile CTA bar hidden
- [ ] Desktop CTA positioned bottom-right
- [ ] 1920px: CTA displays correctly
- [ ] 1440px: CTA displays correctly
- [ ] 1024px: CTA displays correctly

### Mobile (< 768px)
- [ ] Mobile CTA bar visible (when scrolled)
- [ ] Desktop CTA hidden
- [ ] Mobile bar spans full width
- [ ] 767px: Mobile bar displays correctly
- [ ] 375px: Mobile bar displays correctly
- [ ] 360px: Mobile bar displays correctly

## Accessibility Tests

### Keyboard Navigation
- [ ] Close buttons keyboard accessible
- [ ] Tab key reaches close buttons
- [ ] Enter key activates close buttons
- [ ] CTA links keyboard accessible
- [ ] Tab key reaches CTA links

### ARIA Attributes
- [ ] Desktop close button has `aria-label="Close sticky button"`
- [ ] Mobile close button has `aria-label="Close sticky bar"`
- [ ] Labels descriptive for screen readers

### Focus States
- [ ] Close buttons show focus indicator
- [ ] CTA links show focus indicator
- [ ] Focus indicators visible and clear

## Visual/UX Tests

### Transitions
- [ ] Smooth fade-in (300ms)
- [ ] Smooth fade-out (300ms)
- [ ] Transform animation (translateY)
- [ ] No jarring appearances/disappearances

### Shadows
- [ ] Desktop button has prominent shadow
- [ ] Mobile bar has subtle top shadow
- [ ] Shadows create depth perception
- [ ] Shadows not excessive

### Hover States
- [ ] Desktop button lifts on hover (-2px)
- [ ] Mobile buttons lift on hover (-2px)
- [ ] Shadow increases on hover
- [ ] Smooth transition (200ms)

## Browser Testing

- [ ] Chrome (desktop & mobile)
- [ ] Firefox (desktop & mobile)
- [ ] Safari (desktop & iOS)
- [ ] Edge (desktop)
- [ ] Chrome DevTools responsive mode

## Performance Tests

- [ ] No console errors
- [ ] Scroll throttling working (100ms)
- [ ] No memory leaks
- [ ] sessionStorage working correctly
- [ ] Page load not affected by CTA scripts

## Results Summary

**Total Tests:** 115
**Passed:** ___
**Failed:** ___
**Blocked:** ___

**Overall Status:** [PASS/FAIL]

## Notes

- Homepage correctly excluded from sticky CTAs (has hero CTAs instead)
- 200px scroll threshold prevents blocking hero content on other pages
- SessionStorage ensures user preference persists for session
- Scroll throttling (100ms) maintains smooth performance
- Separate CTAs for desktop/mobile optimize for each context
- Yellow "Inquire" button provides alternative to registration CTA
