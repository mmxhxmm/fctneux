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
                roboto: ['Roboto', 'sans-serif'],
                roboto_condensed: ['Roboto Condensed', 'sans-serif'],
                roboto_condensed_bold: ['Roboto Condensed Bold', 'sans-serif'],
                roboto_condensed_italic: ['Roboto Condensed Italic', 'sans-serif'],
                roboto_condensed_bold_italic: ['Roboto Condensed Bold Italic', 'sans-serif'],
                hammersmith: ['Hammersmith One', 'sans-serif'],
            },
            
            colors: {
                blue: "#002F86",
                orange: "#FF8300",
                black_transp: "rgba(0, 0, 0, 0.5)",
                primary: "#263652", // A bit bluer than bg-gray-800
            },
        },
    },

    plugins: [forms],
};
