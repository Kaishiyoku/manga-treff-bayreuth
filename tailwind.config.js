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
            colors: {
                gray: {
                    100: '#fcfcfc',
                    200: '#f7f7f7',
                    300: '#f0f0f0',
                    400: '#e0e0e0',
                    450: '#cccccc',
                    500: '#bfbfbf',
                    600: '#969696',
                    700: '#696969',
                    800: '#474747',
                    900: '#2b2b2b',
                },
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
            typography: {
                default: {
                    css: {
                        color: '#000000',
                        a: {
                            color: '#d53f8c',
                            textDecoration: 'none',
                            '&:hover': {
                                color: '#d53f8c',
                                textDecoration: 'underline',
                            },
                        },
                        h1: {
                            color: '#000000',
                        },
                        h2: {
                            color: '#000000',
                        },
                        h3: {
                            color: '#000000',
                        },
                        h4: {
                            color: '#000000',
                        },
                        strong: {
                            color: '#000000',
                        },
                    },
                },
            },
        }
    },
    variants: {},
    plugins: [
        require('tailwindcss-shadow-outline-colors')(),
        require('@tailwindcss/typography'),
    ],
};
