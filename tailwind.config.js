module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Nunito', 'sans-serif'],
        },
        shadowOutline: {
            'shadow': '0 0 0 .2rem',
            'alpha': '.4',
        },
        height: {
            96: '24rem',
        },
        width: {
            '1/20': '5%',
            '2/20': '10%',
            '3/20': '15%',
            '4/20': '20%',
            '5/20': '25%',
            '6/20': '30%',
            '7/20': '35%',
            '8/20': '40%',
            '9/20': '45%',
            '10/20': '50%',
            '11/20': '55%',
            '12/20': '60%',
            '13/20': '65%',
            '14/20': '70%',
            '15/20': '75%',
            '16/20': '80%',
            '17/20': '85%',
            '18/20': '90%',
            '19/20': '95%',
        },
    }
  },
  variants: {},
  plugins: [
      require('tailwindcss-shadow-outline-colors')(),
  ]
}
