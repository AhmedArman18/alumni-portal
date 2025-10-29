const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Compile JS and CSS for your application.
 |
 */

// Compile app.js (required for chat)
mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
       require('autoprefixer'),
   ]);

// Optional: compile your existing home JS
mix.js('resources/js/home/index.js', 'public/js/home').vue();

// Version files in production
if (mix.inProduction() || true) {
    mix.version();
}
