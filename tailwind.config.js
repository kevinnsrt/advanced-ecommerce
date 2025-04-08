import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                krem: '#FFF0D1',
                coklat1:'#664343',
                coklat2:'#795757',
                coklat3:'#3B3030',
            },
        },
    },
    daisyui: {
        themes: ["light"],
    },

    plugins: [forms,require('daisyui'),],
};
