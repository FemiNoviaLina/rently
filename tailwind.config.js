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
            'white': '#FFFFFF',
            'light-red': '#FDD4D4',
            'red': '#FF5050',
            'gray': {
                50:'#5D5D94',
                100:'#E2E2E2',
                300:'#F3F4F8',
            },    
            'lilac': {
                100: '#7C7DDC',
                200: '#9395DE',
                300: '#A9A9E7',
                400: '#DDDEF5'
            },
            'mint': {
                50: '#1BCE7F',
                100: '#25DE8D',
                200: '#83EEBF',
                300: '#A6F1D0'
            }, 
            'yellow': {
                100: '#AC9D16',
                200: '#FAFDD4'
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
