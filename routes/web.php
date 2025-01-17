<?php

use App\Models\Article;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

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

// Start non localized routes
Route::get('/contact', function () { return redirect(locale_route('contact.index')); });
Route::get('/privacy-policy', function () { return redirect(locale_route('home.privacy-policy')); });
Route::get('/terms-and-conditions', function () { return redirect(locale_route('home.terms-and-conditions')); });

Route::post('/timezone', 'HomeController@timezoneAjax');

// Start localized routes
Route::get('/{language?}', 'HomeController@index')->name('home.index');
Route::get('/{language}/contact', 'ContactController@index')->name('contact.index');
Route::get('/{language}/privacy-policy', 'HomeController@privacyPolicy')->name('home.privacy-policy');
Route::get('/{language}/terms-and-conditions', 'HomeController@termsAndConditions')->name('home.terms-and-conditions');

Route::post('/{language}/contact', 'ContactController@sendMessage')->name('contact.send-message');

Route::group(['namespace' => 'Shop'], function() {
    // Start non localized routes
    Route::get('/events', function () { return redirect(locale_route('events.index')); });
    Route::get('/products', function () { return redirect(locale_route('products.index')); });
    Route::get('/services', function () { return redirect(locale_route('services.index')); });
    Route::get('/pictures', function () { return redirect(locale_route('pictures.index')); });


    Route::get('/products/{product}', function (Product $product) { return redirect(locale_route('products.show', compact('product'))); });
    Route::get('/services/{service}', function (Service $service) { return redirect(locale_route('services.show', compact('service'))); });

    // Start localized routes
    Route::get('/{language}/events', 'EventController@index')->name('events.index');
    Route::get('/{language}/services', 'ServiceController@index')->name('services.index');
    Route::get('/{language}/products', 'ProductController@index')->name('products.index');
    Route::get('/{language}/pictures', 'GalleryController@index')->name('pictures.index');
    Route::get('/{language}/events/ajax', 'EventController@ajaxEvents')->name('events.ajax');

    Route::get('/{language}/products/{product}', 'ProductController@show')->name('products.show');
    Route::get('/{language}/services/{service}', 'ServiceController@show')->name('services.show');
});

Route::group(['namespace' => 'Blog'], function() {
    // Start non localized routes
    Route::get('/articles', function () { return redirect(locale_route('articles.index')); });
    Route::get('/articles/{article}', function (Article $article) { return redirect(locale_route('articles.show', compact("article"))); });

    // Start localized routes
    Route::get('/{language}/articles', 'ArticleController@index')->name('articles.index');
    Route::get('/{language}/articles/ajax', 'ArticleController@ajaxArticles')->name('articles.ajax');
    Route::get('/{language}/articles/{article}', 'ArticleController@show')->name('articles.show');
    Route::get('/{language}/articles/{article}/comments/ajax', 'ArticleController@ajaxComments')->name('article.comments.ajax');

    Route::post('/{language}/articles/{article}/comment', 'ArticleController@comment')->name('articles.comment');
});

Route::group(['namespace' => 'Auth'], function() {
    // Start non localized routes
    Route::get('/login', function () { return redirect(locale_route('login')); });
    Route::get('/register', function () { return redirect(locale_route('register')); });
    Route::get('/password/request', function () { return redirect(locale_route('password.request')); });
    Route::get('/password/reset/{token}', function (String $token) { return redirect(locale_route('password.reset', compact('token'))); });
    Route::get('/account/{email}/confirmation/{token}', function (String $email, String $token) { return redirect(locale_route('account.confirmation', compact('email', 'token'))); });

    // Start localized routes
    Route::get('/{language}/login', 'LoginController@showLoginForm')->name('login');
    Route::get('/{language}/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::get('/{language}/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::get('/{language}/password/request', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('/{language}/account/{email}/confirmation/{token}', 'RegisterController@confirmation')->name('account.confirmation');

    Route::post('/{language}/login', 'LoginController@login');
    Route::post('/{language}/register', 'RegisterController@register');
    Route::post('/{language}/logout', 'LoginController@logout')->name('logout');
    Route::post('/{language}/password/reset/{token}', 'ResetPasswordController@reset');
    Route::post('/{language}/password/request', 'ForgotPasswordController@sendResetLinkEmail');
});

Route::group(['namespace' => 'Customer'], function() {
    // Start non localized routes
    Route::get('/customer/dashboard', function () { return redirect(locale_route('customer.dashboard.index')); });

    // Start localized routes
    Route::get('/{language}/customer/dashboard', 'DashboardController@index')->name('customer.dashboard.index');
});
