const colors = require('tailwindcss/colors')

module.exports = {
    purge: {
        layers: ['utilities'],
        content: [
            './resources/views/**/*.blade.php',
            './resources/css/**/*.css',
        ],
        options: {
            whitelist: ['lg:hidden', 'xl:inline-block'],
        }
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', 'sans-serif'],
            },
            colors: {
                gray: colors.gray,
                teal: colors.teal,
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
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
