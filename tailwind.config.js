import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'selector',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'pura1': "url('//127.0.0.1:8000/images/pura1.jpg')",
                'pura2': "url('//127.0.0.1:8000/images/pura2.jpg')",
                'pura3': "url('//127.0.0.1:8000/images/pura3.jpg')"
            }
        },
    },

    plugins: [forms, typography],
};
