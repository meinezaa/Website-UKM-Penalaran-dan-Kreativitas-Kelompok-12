/** @type {import('tailwindcss').Config} */
module.exports = {
<<<<<<< HEAD
  content: [
    "./public/**/*.{html,js,php}", 
    "./public/**/*.{html,php,js}",    
    "./*.{html,php}"                      
  ],
=======
content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/**/*.html",
    "./src/**/*.{html,js}"
],
>>>>>>> 769d9507fae0ea2031751eaef58ec82bc72a15ce
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        instrument: ['"Instrument Serif"', "serif"],
      },
    },
  },
  plugins: [],
};
