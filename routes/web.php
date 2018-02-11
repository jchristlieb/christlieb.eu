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
Route::get('/', 'IndexController');

// Blog Routes
Route::get('/blog', 'ArticlesController@index')->name('articles.index');
Route::get('/blog/{slug}', 'ArticlesController@show')->name('articles.show');
Route::delete('/articles/{id}', 'ArticlesController@destroy')->name('articles.delete')->middleware('auth');
Route::get('/articles/create', 'ArticlesController@create')->name('articles.create')->middleware('auth');
Route::post('/articles/create', 'ArticlesController@store')->name('articles.store')->middleware('auth');

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
