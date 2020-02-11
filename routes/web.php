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

Auth::routes();

Route::get('/',function(){
	return redirect('/home');
});
Route::get('/home', 'ArticleController@index')->name('home');
Route::get('/show/{slug}', 'ArticleController@show');
Route::get('/update/{slug}', 'ArticleController@getEdit')->name('edit')->middleware(['auth']);
Route::post('/update/{slug}', 'ArticleController@postEdit')->name('postEdit')->middleware(['auth']);
Route::get('/create', 'ArticleController@getCreate')->name('create')->middleware(['auth']);
Route::post('/create', 'ArticleController@postCreate')->name('postCreate')->middleware(['auth']);
Route::delete('/delete/{slug}', 'ArticleController@delete')->name('delete')->middleware(['auth']);
Route::get('/category/{slug}', 'ArticleController@byCategory')->name('byCategory');
