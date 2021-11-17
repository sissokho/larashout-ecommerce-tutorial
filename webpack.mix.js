const mix = require('laravel-mix');

mix.copyDirectory('resources/backend', 'public/backend');
mix.copyDirectory('resources/frontend', 'public/frontend');

mix.js('resources/js/app.js', 'public/backend/js')
    .vue({ version: 2 });
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ]);
