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
            }
        },
    },

    plugins: [forms, typography],
};
