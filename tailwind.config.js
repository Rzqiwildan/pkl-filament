import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
            },
            colors :{
                cblack :{
                    0:"#001321", //Footer
                    1:"#333333" // Font Judul
                },
                cgrey :{
                    0:"#666666" // Deskripsi
                },
                cblue :{
                    0 :"#2EA3F2", // Text Link
                    1 :"#1B86B7" // Icon
                }
            }
        },
    },
    plugins: [],
};
