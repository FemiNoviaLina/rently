const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            'black': '#000000',
            'white': '#ffffff',
            'gray': {
                50:'#5D5D94',
                100:'#E2E2E2',
                300:'#F3F4F8',
            },    
            'lilac': {
                100: '#7C7DDC',
                200: '#9395DE',
                300: '#A9A9E7',
            },
            'mint': {
                100: '#66E9AF',
                200: '#83EEBF',
                300: '#A6F1D0'
            }
        },
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
