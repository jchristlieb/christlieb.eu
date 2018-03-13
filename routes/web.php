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

// Front page
Route::get('/', 'IndexController')->name('index');

// Static Pages
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/legal-notice', function () {
    return view('legal-notice');
})->name('legal-notice');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// RSS Routes
Route::feeds();

// Contact Page
Route::get('/contact', 'ContactController@show')->name('contact');
Route::post('/contact', 'ContactController@store')->name('contact.store');

// Blog Routes
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{slug}', 'BlogController@single')->name('articles.show');
Route::post('/blog/{slug}/comments', 'CommentsController@store')->name('articles.comments.store');

//Tag Routes
Route::get('/tags', 'TagsController@index')->name('tags.index');
Route::get('/tags/{slug}', 'TagsController@show')->name('tags.show');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Admin Routes
