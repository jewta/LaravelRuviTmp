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

Route::namespace('Admin')->prefix('admin')->middleware('auth')->group(function(){

	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	Route::resource('languages', 'LanguagesController');
	Route::resource('menu', 'MenuController');

});
