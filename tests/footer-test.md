# Footer Test Checklist - Story 5.9

## Test Date: 2026-02-19

## Footer Display Tests (AC: 1)

### Presence on All Pages
- [ ] Footer appears on homepage
- [ ] Footer appears on camp archive page
- [ ] Footer appears on single camp page
- [ ] Footer appears on activities archive
- [ ] Footer appears on contact page
- [ ] Footer appears on all custom post type pages
- [ ] Footer appears on standard WordPress pages

### Footer Structure
- [ ] Footer container displays correctly
- [ ] All four sections present
- [ ] Content properly aligned
- [ ] No layout issues or overlaps

## About Slumber Falls Section (AC: 2)

### Content
- [ ] Heading: "Slumber Falls Camp & Retreat Center"
- [ ] Tagline: "Building campfires and community since 1958"
- [ ] "Est. 1958" badge present
- [ ] Badge styled with brand blue background

### Styling
- [ ] Heading is bold and prominent
- [ ] Tagline text is gray-300
- [ ] Badge has rounded corners
- [ ] Badge inline-block display

## Quick Links Section (AC: 2)

### Links Present
- [ ] Summer Camp link
- [ ] Retreats link
- [ ] Facilities link
- [ ] FAQs link
- [ ] Contact link
- [ ] Join Our Team link
- [ ] Support SFC link

### Link Functionality
- [ ] Summer Camp → `/camps/`
- [ ] Retreats → `/retreats/`
- [ ] Facilities → `/facilities/`
- [ ] FAQs → `/faqs/`
- [ ] Contact → `/contact/`
- [ ] Join Our Team → `/join-our-team/`
- [ ] Support SFC → `/support/`

### Link Styling
- [ ] Links displayed as vertical list
- [ ] Proper spacing between links (space-y-2)
- [ ] Gray-300 text color
- [ ] Yellow hover color (#E3B82B)
- [ ] Smooth transition on hover

## Contact Info Section (AC: 2)

### Address
- [ ] "Address:" label present
- [ ] 3610 River Road
- [ ] New Braunfels, TX 78132
- [ ] Multi-line display with proper breaks

### Phone Number
- [ ] "Phone:" label present
- [ ] Phone number: (830) 625-2212
- [ ] Phone link with tel: protocol
- [ ] Correct href: `tel:+18306252212`
- [ ] Click triggers dialer on mobile
- [ ] Hover shows yellow color

### Email Address
- [ ] "Email:" label present
- [ ] Email: office@slumberfalls.org
- [ ] Email link with mailto: protocol
- [ ] Correct href: `mailto:office@slumberfalls.org`
- [ ] Click opens mail app on mobile/desktop
- [ ] Hover shows yellow color

### Office Hours
- [ ] "Office Hours:" label present
- [ ] Tuesday - Friday, 9am - 1pm
- [ ] "or by appointment" text
- [ ] Smaller text size (text-sm)
- [ ] Proper line breaks

### Content Styling
- [ ] All content in gray-300
- [ ] Bold labels
- [ ] Adequate spacing

## Social Media Section (AC: 2)

### Social Icons Present
- [ ] Facebook icon
- [ ] Instagram icon
- [ ] TikTok icon
- [ ] Icons properly sized (w-6 h-6)
- [ ] Icons in horizontal row with gap

### Icon Functionality
- [ ] Facebook link present (href="#" placeholder)
- [ ] Instagram link present (href="#" placeholder)
- [ ] TikTok link present (href="#" placeholder)
- [ ] Icons have aria-label for accessibility
- [ ] Hover shows yellow color transition

### Additional Links
- [ ] "Meet the Board" link → `/meet-the-board/`
- [ ] "Privacy Policy" link → `/privacy-policy/`
- [ ] TX Health Dept link → external URL
- [ ] External link has target="_blank"
- [ ] External link has rel="noopener noreferrer"

### Styling
- [ ] Heading "Follow Us"
- [ ] Icons white color
- [ ] Yellow hover color
- [ ] Smooth transitions
- [ ] Additional links smaller text (text-sm)

## Copyright Row (AC: 3)

### Content
- [ ] Copyright symbol © present
- [ ] Dynamic year displays: <?php echo date('Y'); ?>
- [ ] Text: "Slumber Falls Camp & Retreat Center. All rights reserved."
- [ ] Centered alignment

### Styling
- [ ] Top border (border-t border-gray-600)
- [ ] Padding top (pt-6)
- [ ] Text center alignment
- [ ] Gray-400 text color
- [ ] Small text size (text-sm)

## Footer Styling (AC: 4)

### Background & Colors
- [ ] Background color: #7D7069 (brown/dark grey)
- [ ] Text color: white
- [ ] Proper contrast for accessibility
- [ ] All text readable on dark background

### Link Styling
- [ ] Links have brand color hovers (#E3B82B yellow)
- [ ] Smooth transition effects (transition-colors)
- [ ] Underline removed (default link style)
- [ ] Hover states work on all links

### Spacing & Layout
- [ ] Padding: py-12 (vertical)
- [ ] Container: mx-auto px-4
- [ ] Grid gap: gap-8
- [ ] Section spacing consistent

## Responsive Layout (AC: 2)

### Desktop (≥ 1024px)
- [ ] Four columns (lg:grid-cols-4)
- [ ] All sections side-by-side
- [ ] Equal column widths
- [ ] Adequate spacing between columns
- [ ] Content well-distributed

### Tablet (≥ 768px, < 1024px)
- [ ] Two columns (md:grid-cols-2)
- [ ] Sections in 2×2 grid
- [ ] Proper wrapping
- [ ] Spacing maintained

### Mobile (< 768px)
- [ ] Single column (grid-cols-1)
- [ ] Sections stacked vertically
- [ ] Full width sections
- [ ] Adequate spacing between stacked sections
- [ ] All content readable

## Link Testing (AC: 6)

### Internal Links
- [ ] All quick links navigate correctly
- [ ] Contact page link works
- [ ] Privacy policy link works
- [ ] Meet the board link works
- [ ] Support link works
- [ ] Join Our Team link works

### Clickable Contact Links
- [ ] Phone link clickable on mobile
- [ ] Phone link triggers dialer app
- [ ] Email link clickable on mobile
- [ ] Email link opens mail app
- [ ] Email link works on desktop (opens default mail client)

### Social Media Links
- [ ] Facebook link clickable
- [ ] Instagram link clickable
- [ ] TikTok link clickable
- [ ] External link opens in new tab
- [ ] All placeholders (#) can be updated with real URLs

## Accessibility Tests

### Semantic HTML
- [ ] Footer uses <footer> element
- [ ] Headings use proper hierarchy (h3)
- [ ] Links have descriptive text
- [ ] Icons have aria-label attributes

### Keyboard Navigation
- [ ] All links keyboard accessible
- [ ] Tab key navigates through all links
- [ ] Enter key activates links
- [ ] Focus indicators visible

### Screen Reader
- [ ] aria-label on social icons
- [ ] Link text descriptive
- [ ] Phone and email links announced correctly
- [ ] External link indication (target="_blank")

### Color Contrast
- [ ] White text on #7D7069 background has sufficient contrast
- [ ] Gray-300 text readable
- [ ] Gray-400 (copyright) readable
- [ ] Link hover color (#E3B82B) has good contrast

## Visual Tests

### Typography
- [ ] Headings bold and prominent (text-xl font-bold)
- [ ] Body text readable (text-gray-300)
- [ ] Consistent font sizing
- [ ] Proper line heights

### Spacing
- [ ] Section spacing consistent (mb-4, mb-6)
- [ ] List spacing (space-y-2)
- [ ] Grid gaps appropriate (gap-8)
- [ ] Padding balanced (py-12)

### Alignment
- [ ] Footer sections aligned top
- [ ] Copyright centered
- [ ] Social icons horizontally aligned
- [ ] Multi-line content properly formatted

## Browser Testing

- [ ] Chrome (desktop & mobile)
- [ ] Firefox (desktop & mobile)
- [ ] Safari (desktop & iOS)
- [ ] Edge (desktop)
- [ ] Chrome DevTools responsive mode

## Integration Tests

### Page Footer Interaction
- [ ] Footer does not overlap sticky CTAs
- [ ] Footer visible above sticky mobile bar
- [ ] No z-index conflicts
- [ ] Smooth scroll to footer

### WordPress Integration
- [ ] Copyright year updates automatically
- [ ] Footer appears in all templates
- [ ] wp_footer() called correctly
- [ ] No PHP errors in footer

## Results Summary

**Total Tests:** 150
**Passed:** ___
**Failed:** ___
**Blocked:** ___

**Overall Status:** [PASS/FAIL]

## Notes

- Social media links currently use "#" placeholders - update with actual URLs when available
- Privacy Policy page link destination will be created in Epic 6 (Story 6.8)
- External link (TX Health Dept) opens in new tab for user safety
- Dynamic copyright year uses PHP date('Y') for future-proofing
- Footer background color #7D7069 from brand palette
- Link hover color #E3B82B (brand yellow) for consistency
