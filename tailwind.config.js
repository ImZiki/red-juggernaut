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
                'sans': ['OCR', 'sans-serif'],
            },
        },
    },

    plugins: [forms],

    extend: {
        backgroundImage: {
            'custom': "url('/public/images/background.png')",
        },
        backgroundSize: {
            'cover': 'cover',
        },
        backgroundPosition: {
            'center': 'center',
        },
        backgroundAttachment: {
            'fixed': 'fixed',
        }
    }

};
