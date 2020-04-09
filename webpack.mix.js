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

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/index.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/header.scss', 'public/css')
.sass('resources/sass/menu.scss', 'public/css')
.sass('resources/sass/slide.scss', 'public/css')
.sass('resources/sass/product.scss', 'public/css')
.sass('resources/sass/article.scss', 'public/css')
.sass('resources/sass/provider.scss', 'public/css')
.sass('resources/sass/footer.scss', 'public/css')
.sass('resources/sass/shop.scss', 'public/css')
.sass('resources/sass/single.scss', 'public/css')
.sass('resources/sass/cart.scss', 'public/css')
.sass('resources/sass/checkout.scss', 'public/css')
.sass('resources/sass/news.scss', 'public/css')
.sass('resources/sass/new_single.scss', 'public/css')
.sass('resources/sass/contact.scss', 'public/css');
