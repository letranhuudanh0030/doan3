<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', 'FrontendController@index')->name('home');

Route::get('/{slug}-cp{id?}.html', 'FrontendController@shop')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('shop');

Route::get('/{slug}-p{id?}.html', 'FrontendController@single')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('single');

Route::get('/tin-tuc.html', 'FrontendController@new')->name('new');

Route::get('/{slug}-a{id?}.html', 'FrontendController@singleNew')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('single.new');

Route::get('/gio-hang.html', 'CartController@cart')->name('cart');
Route::post('/post-cart.html', 'CartController@postCart')->name('add.cart');
Route::post('/upate-cart.html', 'CartController@updateCart')->name('update.cart');
Route::post('/remove-cart.html', 'CartController@removeCart')->name('remove.cart');
Route::get('/clear-cart.html', 'CartController@clearCart')->name('clear.cart');

Route::get('/thanh-toan.html', 'CartController@checkout')->name('checkout');
Route::post('/send-checkout', 'CartController@postCheckout')->name('post.checkout');
Route::get('/ket-qua.html', 'CartController@resultCheckout')->name('result');
Route::get('/responese.html', 'CartController@responseCheckout')->name('response');

Route::post('/tim-kiem.html', 'FrontendController@search')->name('search');
Route::get('/tim-kiem.html', 'FrontendController@search')->name('searchAuto');


Route::get('/lien-he.html', 'FrontendController@contact')->name('contact');
Route::post('/send', 'FrontendController@sendMail')->name('send_contact');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/order/{status}-{publish}', 'Admin\DashboardController@checkOrder')->where('status', '[0-9]+')->where('publish', '[0-9]+')->name('check.order');
    
    Route::resource('product_category', 'Admin\ProductCategoryController');
    Route::post('product_category/update-status', 'Admin\ProductCategoryController@updateStatus')->name('product_category.updateStatus');
    Route::post('product_category/remove', 'Admin\ProductCategoryController@remove')->name('product_category.remove');
    Route::post('product_category/search', 'Admin\ProductCategoryController@search')->name('product_category.search');

    Route::resource('product', 'Admin\ProductController');
    Route::post('product/update-status', 'Admin\ProductController@updateStatus')->name('product.updateStatus');
    Route::post('product/remove', 'Admin\ProductController@remove')->name('product.remove');
    Route::post('product/search', 'Admin\ProductController@search')->name('product.search');

    Route::resource('provider', 'Admin\ProviderController');
    Route::post('provider/update-status', 'Admin\ProviderController@updateStatus')->name('provider.updateStatus');
    Route::post('provider/remove', 'Admin\ProviderController@remove')->name('provider.remove');
    Route::post('provider/search', 'Admin\ProviderController@search')->name('provider.search');

    Route::resource('article_category', 'Admin\ArticleCategoryController');
    Route::post('article_category/update-status', 'Admin\ArticleCategoryController@updateStatus')->name('article_category.updateStatus');
    Route::post('article_category/remove', 'Admin\ArticleCategoryController@remove')->name('article_category.remove');
    Route::post('article_category/search', 'Admin\ArticleCategoryController@search')->name('article_category.search');

    Route::resource('article', 'Admin\ArticleController');
    Route::post('article/update-status', 'Admin\ArticleController@updateStatus')->name('article.updateStatus');
    Route::post('article/remove', 'Admin\ArticleController@remove')->name('article.remove');
    Route::post('article/search', 'Admin\ArticleController@search')->name('article.search');

    Route::resource('slideshow', 'Admin\SlideShowController');
    Route::post('slideshow/update-status', 'Admin\SlideShowController@updateStatus')->name('slideshow.updateStatus');
    Route::post('slideshow/remove', 'Admin\SlideShowController@remove')->name('slideshow.remove');
    Route::post('slideshow/search', 'Admin\SlideShowController@search')->name('slideshow.search');

    Route::get('order', 'Admin\OrderController@index')->name('order');
    Route::post('order/post', 'Admin\OrderController@postOrder')->name('post.order');
    Route::post('order/search', 'Admin\OrderController@search')->name('order.search');


    Route::get('config', 'Admin\ConfigController@index');
    Route::post('config/post', 'Admin\ConfigController@postConfig')->name('config.post');

    Route::get('gallery', function(){
        return view('backend.gallery');
    });
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
