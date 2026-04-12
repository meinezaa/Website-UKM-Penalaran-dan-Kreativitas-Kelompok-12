/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,js,php}", 
    "./src/**/*.{html,js,php}",    
    "./*.php"                      
  ],
  content: ["./public/**/*.{html,js,php}", "./src/**/*.{html,js,php}", "./*.php"],
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
