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
      },
    },
  },
  plugins: [],
}
