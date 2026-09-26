/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './template-parts/**/*.php',
    './page-templates/**/*.php',
    './inc/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        // Primary brand colors from logo
        'brand-blue': {
          DEFAULT: '#558EAF',
          50: '#E8F1F6',
          100: '#D1E3ED',
          200: '#A3C7DB',
          300: '#75ABC9',
          400: '#558EAF', // Base
          500: '#447291',
          600: '#335773',
          700: '#223B55',
          800: '#111F37',
          900: '#000319',
        },
        'brand-yellow': {
          DEFAULT: '#E3B82B',
          50: '#FCF7E6',
          100: '#F9EFCD',
          200: '#F3DF9B',
          300: '#EDCF69',
          400: '#E3B82B', // Base
          500: '#C9A022',
          600: '#A68419',
          700: '#836810',
          800: '#604C07',
          900: '#3D3000',
        },
        'brand-green': {
          DEFAULT: '#2F7735',
          50: '#E9F3EA',
          100: '#D3E7D5',
          200: '#A7CFAB',
          300: '#7BB781',
          400: '#4F9F57',
          500: '#2F7735', // Base
          600: '#265F2B',
          700: '#1D4721',
          800: '#142F17',
          900: '#0B170D',
        },
        'brand-brown': {
          DEFAULT: '#AA762A',
          50: '#F6F0E6',
          100: '#EDE1CD',
          200: '#DBC39B',
          300: '#C9A569',
          400: '#B78737',
          500: '#AA762A', // Base
          600: '#885E22',
          700: '#66461A',
          800: '#442E12',
          900: '#22160A',
        },

        // Warm neutral backgrounds
        'warm': {
          50: '#FAF8F3',
          100: '#F5F1E8',
          200: '#EDE8D3',
          300: '#E5DCC0',
        },

        // Enhanced accent gold
        'accent-gold': {
          DEFAULT: '#E2B148',
          50: '#FDF8E8',
          100: '#FAEFC9',
          400: '#E2B148',
          500: '#D9A532',
          600: '#C18E1C',
        },

        // Expanded nature greens
        'nature': {
          100: '#E9F3EA',
          300: '#7FA62D',
          500: '#2F7735',
          700: '#1D4721',
          900: '#0B170D',
        },
      },
      fontFamily: {
        'display': ['Fredoka', 'sans-serif'],
        'heading': ['DM Sans', 'sans-serif'],
        'sans': ['Inter', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-lg': ['4.5rem', { lineHeight: '1.1', fontWeight: '700' }],
        'display': ['3.5rem', { lineHeight: '1.15', fontWeight: '700' }],
        'display-sm': ['2.75rem', { lineHeight: '1.2', fontWeight: '600' }],
      },
      boxShadow: {
        'card': '0 2px 8px rgba(0, 0, 0, 0.08)',
        'card-hover': '0 8px 24px rgba(0, 0, 0, 0.12)',
        'button': '0 2px 6px rgba(0, 0, 0, 0.15)',
        'button-hover': '0 6px 16px rgba(0, 0, 0, 0.2)',
        'section': '0 -4px 12px rgba(0, 0, 0, 0.05)',
      },
      animation: {
        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
        'fade-in': 'fadeIn 0.8s ease-out forwards',
        'zoom-in': 'zoomIn 0.5s ease-out forwards',
        'slide-in-right': 'slideInRight 0.7s ease-out forwards',
      },
      keyframes: {
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        zoomIn: {
          '0%': { opacity: '0', transform: 'scale(0.92)' },
          '100%': { opacity: '1', transform: 'scale(1)' },
        },
        slideInRight: {
          '0%': { opacity: '0', transform: 'translateX(-40px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
      },
    },
  },
  plugins: [],
}

/*
 * WAVE DIVIDER IMPLEMENTATION REFERENCE
 * River Theme: Waves symbolize the river beside Slumber Falls Camp (River Road)
 *
 * Standard Wave (Top of Section):
 * <div class="w-full relative -mb-1">
 *   <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-warm-50 w-full h-12 md:h-20">
 *     <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
 *   </svg>
 * </div>
 *
 * Inverted Wave (Bottom of Section):
 * <div class="w-full relative -mt-1">
 *   <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-warm-50 w-full h-12 md:h-20 rotate-180">
 *     <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
 *   </svg>
 * </div>
 *
 * Usage Pattern:
 * - Color: Change text-warm-50 to match background of section wave transitions TO
 * - Examples: text-white, text-brand-blue-100, text-warm-100
 * - Height: h-12 (mobile 48px), md:h-20 (desktop 80px)
 * - Layout: Use -mb-1 to eliminate gaps, -mt-1 for inverted waves
 * - Brand: Consistent wave shape throughout, only color changes per section
 */
