const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            screens: {
                'max-2xl': { 'max': '1535px' },

                'max-xl': { 'max': '1279px' },

                'max-lg': { 'max': '1023px' },

                'max-md': { 'max': '767px' },

                'max-sm': { 'max': '639px' },
            },
            colors: {
                "primary": '#1f81a6',
                "secundary": '#f2f2f2',
                "third": '#6a7175',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
