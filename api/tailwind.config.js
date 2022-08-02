/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: {
        content: [
            "./resources/**/*.blade.php",
            "./resources/**/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        ]
    },
  theme: {
        container: {
            center: true
        },
    extend: {},
  },
  plugins: [],
}
