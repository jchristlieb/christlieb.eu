<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "auth" middleware groups. The Controller namespace
| is App\Http\Controllers\Admin
|
*/

// Dashboard
Route::get('/', 'DashboardController');

// Article Routes
Route::get('/articles', 'ArticlesController@index')->name('admin.articles.index');
Route::delete('/articles/{id}', 'ArticlesController@destroy')->name('admin.articles.delete');
Route::get('/articles/create', 'ArticlesController@create')->name('admin.articles.create');
Route::post('/articles/create', 'ArticlesController@store')->name('admin.articles.store');

// Tag Routes
Route::get('/tags', 'TagsController@index')->name('admin.tags.index');

