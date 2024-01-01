/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.php",
    "./page-template/*.php",
    "./template-parts/**/*.php",
    "./woocommerce/**/*.php",
  ],
  theme: {
    fontFamily: {
      sans: ['Open Sans', 'sans-serif'],
    },
    container: {
      center: true,
      padding: '1rem',
    },
    extend: {},
  },
  plugins: [],
}