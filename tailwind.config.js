/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // screens: {
      //   'print-only': { 'raw': 'print' }, // Create a custom screen
      // },
    },
  },
  plugins: [],
}
