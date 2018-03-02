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
Route::get('/', 'DashboardController')->name('admin.dashboard');

// Article Routes
Route::get('/articles', 'ArticlesController@index')->name('admin.articles.index');
Route::get('/articles/create', 'ArticlesController@create')->name('admin.articles.create');
Route::get('/articles/edit/{id}', 'ArticlesController@edit')->name('admin.articles.edit');
Route::get('/articles/{id}', 'ArticlesController@show')->name('admin.articles.show');
Route::patch('/articles/{id}', 'ArticlesController@update')->name('admin.articles.update');
Route::delete('/articles/{id}', 'ArticlesController@destroy')->name('admin.articles.delete');
Route::post('/articles/create', 'ArticlesController@store')->name('admin.articles.store');

// Tag Routes
Route::get('/tags', 'TagsController@index')->name('admin.tags.index');
Route::get('/tags/{id}', 'TagsController@show')->name('admin.tags.show');
Route::patch('/tags/{id}', 'TagsController@update')->name('admin.tags.update');
Route::delete('/tags/{tagId}/articles/{articleId}', 'TagsController@deleteArticleRelation')->name('admin.tags.article.delete');

// Image Routes
Route::get('/images', 'ImagesController@index')->name('admin.images.index');
Route::post('/images', 'ImagesController@store')->name('admin.images.store');

// Profile Routes
Route::get('/profile', 'ProfileController@show')->name('admin.profile.show');
Route::patch('/profile', 'ProfileController@update')->name('admin.images.update');
