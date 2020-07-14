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

/* Site3 */

.styles([
    'resources/views/site3/css/style.css',
    'resources/views/site3/css/font-awesome.css',
],'public/site3/css/style.css').version()

/* Site3 */

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

/* Dashboard */

.styles([
    'resources/views/dashboard/css/bootstrap.min.css',
    'resources/views/dashboard/css/bootstrap-responsive.min.css',
    'resources/views/dashboard/css/plugins/jquery-ui/smoothness/jquery-ui.css',
    'resources/views/dashboard/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css',
],'public/dashboard/css/bootstrap.css').version()
    
.styles([
    'resources/views/dashboard/css/style.css',
    'resources/views/dashboard/css/themes.css',
],'public/dashboard/css/style.css').version()
    
.scripts([
    'resources/views/dashboard/js/jquery.min.js',
],'public/dashboard/js/jquery.js').version()

.scripts([
	'resources/views/dashboard/js/plugins/nicescroll/jquery.nicescroll.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.core.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.widget.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.mouse.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.draggable.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.resizable.min.js',
	'resources/views/dashboard/js/plugins/jquery-ui/jquery.ui.sortable.min.js',
	'resources/views/dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js',
	'resources/views/dashboard/js/bootstrap.min.js',
	'resources/views/dashboard/js/plugins/form/jquery.form.min.js',
],'public/dashboard/js/jquery-ui.js').version()

.scripts([
    'resources/views/dashboard/js/eakroko.min.js',
    'resources/views/dashboard/js/application.min.js',
    'resources/views/dashboard/js/demonstration.min.js',
],'public/dashboard/js/framework.js').version()

.scripts([
    'resources/views/dashboard/js/plugins/placeholder/jquery.placeholder.min.js',
],'public/dashboard/js/jquery-ie9.js').version()

.scripts([
    'resources/views/dashboard/js/plugins/bootbox/jquery.bootbox.js',
    'resources/views/dashboard/js/plugins/fullcalendar/fullcalendar.min.js',
    'resources/views/dashboard/js/plugins/chosen/chosen.jquery.min.js',
    'resources/views/dashboard/js/plugins/select2/select2.min.js',
],'public/dashboard/js/form.js').version()