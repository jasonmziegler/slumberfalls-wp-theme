# Mobile Menu Test Checklist - Story 5.7

## Test Date: 2026-02-19

## Mobile Display Tests (AC: 1, 2)

### Hamburger Icon Visibility
- [ ] Hamburger icon visible on screens < 768px
- [ ] Hamburger icon hidden on screens ≥ 768px
- [ ] Desktop navigation hidden on screens < 768px
- [ ] Desktop navigation visible on screens ≥ 768px

### Hamburger Button
- [ ] Positioned in top-right of header
- [ ] Minimum 44px tap target (width × height)
- [ ] SVG icon displays correctly (three horizontal lines)
- [ ] Button is easily tappable on mobile devices

## Menu Overlay Tests (AC: 3)

### Opening Menu
- [ ] Tap hamburger button opens menu
- [ ] Menu appears with smooth transition
- [ ] Overlay covers full screen
- [ ] Background is semi-transparent or solid blue

### Overlay Structure
- [ ] Close button (X) visible in top-right
- [ ] Navigation links displayed
- [ ] Menu centered and readable

## Navigation Links Tests (AC: 4)

### Vertical Layout
- [ ] Links displayed vertically
- [ ] Large font size (1.5rem / 24px)
- [ ] Adequate spacing between links (1.5rem margin)
- [ ] Links are thumb-friendly (min 44px height)

### Link List
- [ ] Home link present
- [ ] Camps link present
- [ ] Activities link present
- [ ] Instructors link present
- [ ] Retreats link present
- [ ] FAQs link present
- [ ] About link present
- [ ] Contact link present

## Menu Close Tests (AC: 5, 6)

### Link Tap
- [ ] Tap any navigation link
- [ ] Page navigates correctly
- [ ] Menu closes after navigation

### Close Button
- [ ] Tap X button
- [ ] Menu closes with smooth transition
- [ ] Focus returns to hamburger button

### Outside Tap
- [ ] Tap overlay background (outside menu container)
- [ ] Menu closes

### Escape Key
- [ ] Press Escape key when menu is open
- [ ] Menu closes

## JavaScript Functionality Tests (AC: 7)

### Class Toggle
- [ ] Opening menu adds `.is-open` class to overlay
- [ ] Closing menu removes `.is-open` class
- [ ] Menu display toggles correctly

### Body Scroll Lock
- [ ] Body scroll disabled when menu open (overflow: hidden)
- [ ] Body scroll re-enabled when menu closes
- [ ] Background content does not scroll when menu open

## Accessibility Tests (AC: 8)

### ARIA Attributes
- [ ] Hamburger button has `aria-label="Toggle navigation"`
- [ ] Hamburger button has `aria-expanded="false"` when closed
- [ ] `aria-expanded` changes to "true" when menu opens
- [ ] `aria-expanded` changes back to "false" when menu closes
- [ ] Menu overlay has `role="dialog"`
- [ ] Menu overlay has `aria-modal="true"`
- [ ] Close button has `aria-label="Close navigation menu"`

### Focus Management
- [ ] Opening menu moves focus to close button
- [ ] Closing menu returns focus to hamburger button
- [ ] Tab key cycles through menu items only (focus trap)
- [ ] Shift+Tab cycles backwards through menu items
- [ ] Focus does not escape menu while open

### Keyboard Navigation
- [ ] All interactive elements keyboard accessible
- [ ] Enter key activates buttons and links
- [ ] Escape key closes menu

## Screen Size Tests (AC: 9)

### Mobile Devices (< 768px)
- [ ] iPhone SE (375px): Menu functions correctly
- [ ] iPhone 12/13 (390px): Menu functions correctly
- [ ] Samsung Galaxy (360px): Menu functions correctly
- [ ] Tablet portrait (768px): Menu functions correctly

### Desktop (≥ 768px)
- [ ] Tablet landscape (1024px): Desktop nav shows, mobile hidden
- [ ] Desktop (1440px): Desktop nav shows, mobile hidden
- [ ] Large desktop (1920px): Desktop nav shows, mobile hidden

## Integration Tests

### Menu Content
- [ ] Same menu items in desktop and mobile menus
- [ ] WordPress admin menu changes reflect in both menus
- [ ] Fallback menu works if no menu assigned
- [ ] Custom menu displays correctly

### Active State
- [ ] Current page highlighted in mobile menu
- [ ] Active state styling visible (background + border)
- [ ] Only current page is highlighted

## Visual/UX Tests

### Transitions
- [ ] Smooth fade-in when opening (300ms)
- [ ] Smooth fade-out when closing (300ms)
- [ ] No jarring jumps or layout shifts

### Touch Targets
- [ ] All buttons minimum 44×44px
- [ ] Links have adequate padding
- [ ] Easy to tap on small screens

### Styling
- [ ] Blue background (#558EAF) matches brand
- [ ] White text readable on blue background
- [ ] Hover states work on links
- [ ] Close button easily visible

## Browser Testing

- [ ] Chrome Mobile (Android)
- [ ] Safari (iOS)
- [ ] Firefox Mobile
- [ ] Edge Mobile
- [ ] Chrome DevTools responsive mode

## Results Summary

**Total Tests:** 75
**Passed:** ___
**Failed:** ___
**Blocked:** ___

**Overall Status:** [PASS/FAIL]

## Notes

- JavaScript uses vanilla ES6 (no jQuery or frameworks)
- Focus trap prevents tabbing outside menu
- Body scroll lock improves UX
- Escape key provides additional close method
- All accessibility attributes properly implemented
