/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,js,php}", 
    "./public/**/*.{html,php,js}",    
    "./*.{html,php}"                      
  ],
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
