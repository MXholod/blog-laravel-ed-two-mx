const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js')
	.postCss('resources/css/app.css', 'public/css', [
        //Include tailwind css
		require('tailwindcss')
    ]);*/
    
mix.js('resources/js/app.js', 'public/js').vue()
mix.js('resources/js/admin/app.js', 'public/js/admin').vue()
	.sass('resources/css/site/app.scss', 'public/css', {
	  //To avoid message:	'Using / for division is deprecated and will be removed'
	  sassOptions: {
		quietDeps: true,
	  },
	}).version()
	.sass('resources/css/admin/app.scss', 'public/css/admin', {
	  //To avoid message:	'Using / for division is deprecated and will be removed'
	  sassOptions: {
		quietDeps: true,
	  },
	}).version()
	//.styles(['resources/css/site/app.css'], 'public/css/app.css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')]
	});
mix.copy('resources/images', 'public/images');
mix.copy('resources/fonts', 'public/fonts');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts','public/webfonts');
//Bootstrap-icons fonts
mix.copy('node_modules/bootstrap-icons/font/fonts','public/css/fonts');
