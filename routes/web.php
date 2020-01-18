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

Route::get('/', function () {
    return view('auth\login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::middleware('auth')->name('client.')->prefix('client')->group(function() {
	Route::get('edit/{id}', 'ClientController@edit')->name('edit');
    Route::post('edit', 'ClientController@update')->name('update');
	Route::delete('delete/{id}', 'ClientController@delete')->name('delete');
    Route::get('create', 'ClientController@create')->name('create');
	Route::post('create', 'ClientController@save')->name('save');
    Route::get('dt', 'ClientController@dt')->name('dt');
    Route::get('', 'ClientController@index')->name('index');
    Route::post('select', 'ClientController@select')->name('select');
});

Route::middleware('auth')->name('product.')->prefix('product')->group(function() {
	Route::get('edit/{id}', 'ProductController@edit')->name('edit');
    Route::post('edit', 'ProductController@update')->name('update');
	Route::delete('delete/{id}', 'ProductController@delete')->name('delete');
    Route::get('create', 'ProductController@create')->name('create');
	Route::post('create', 'ProductController@save')->name('save');
    Route::get('dt', 'ProductController@dt')->name('dt');
    Route::get('', 'ProductController@index')->name('index');
});

Route::middleware('auth')->name('order.')->prefix('order')->group(function() {
	Route::get('edit/{id}', 'OrderController@edit')->name('edit');
    Route::post('edit', 'OrderController@update')->name('update');
	Route::delete('delete/{order}', 'OrderController@delete')->name('delete');
    Route::get('create', 'OrderController@create')->name('create');
	Route::post('create', 'OrderController@save')->name('save');
    Route::get('dt', 'OrderController@dt')->name('dt');
    Route::get('', 'OrderController@index')->name('index');
    Route::get('products/{order}', 'OrderController@products')->name('products');
    Route::get('addProduct/{order}', 'OrderController@addProduct')->name('addProduct');
});



