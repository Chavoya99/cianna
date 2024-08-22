import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Century Gothic', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'cianna-gray': '#BFBEBA',
                'cianna-white': '#F1EFE7',
                'cianna-orange': '#D47814',
                'cianna-green': '#2B7B2C',
                'cianna-blue': '#272D45',
            },
            width: {
                '1/10': '10%',
                '3/20': '15%',
                '17/20': '85%',
                '9/10': '90%',
            },
        },
    },

    fontWeight: {
        thin: '100',
        extralight: '200',
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
    },

    plugins: [
        forms,
        typography,
    ],
};
