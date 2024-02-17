/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.php",
    "./page-templates/**/*.php",
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