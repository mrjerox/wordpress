/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.php",
    "./page-template/*.php",
    "./template-parts/**/*.php",
  ],
  theme: {
    fontFamily: {
      sans: ['Poppins', 'sans-serif'],
    },
    container: {
      center: true,
      padding: '1rem',
    },
    extend: {},
  },
  plugins: [],
}