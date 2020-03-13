const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix

.sass('resources/views/blog/scss/style.scss', 'public/site/style.css')

// don't need version
.scripts(['node_modules/jquery/dist/jquery.js'],'public/site/jquery.js')
.scripts(['node_modules/bootstrap/dist/js/bootstrap.bundle.js'],'public/site/bootstrap.js')

.styles([
    'resources/views/site/css/rest.css',
    'resources/views/site/css/style.css',
],'public/site/css/style.css').version()

.scripts([
    'resources/views/site/js/script.js',
],'public/site/js/script.js').version()

.styles([
    'resources/views/admin/css/style.css'
],'public/admin/css/style.css').version()