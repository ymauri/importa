<?php


Route::get('/', function () {
    return view('auth.login');
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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('city', 'CityController', ['except' => ['show']]);
    Route::get('searchState/{id}', 'CityController@searchState')->name('select_city_by_country');
    Route::get('city/store', 'CityController@insert')->name('store_city');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

});

Route::middleware('auth')->name('client.')->prefix('client')->group(function() {
	Route::get('edit/{id}', 'ClientController@edit')->name('edit');
    Route::post('edit', 'ClientController@update')->name('update');
	Route::delete('delete/{client}', 'ClientController@delete')->name('delete');
    Route::get('create', 'ClientController@create')->name('create');
	Route::post('create', 'ClientController@save')->name('save');
    Route::get('dt', 'ClientController@dt')->name('dt');
    Route::get('', 'ClientController@index')->name('index');
    Route::post('select', 'ClientController@select')->name('select');
    Route::post('selectCity', 'ClientController@selectCity')->name('selectCity');
    Route::post('selectCountry', 'ClientController@selectCountry')->name('selectCountry');
});

Route::middleware('auth')->name('product.')->prefix('product')->group(function() {
	Route::get('edit/{id}', 'ProductController@edit')->name('edit');
    Route::post('edit', 'ProductController@update')->name('update');
	Route::delete('delete/{product}', 'ProductController@delete')->name('delete');
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
    Route::post('addProduct', 'OrderController@addProduct')->name('addProduct');
    Route::delete('deleteProduct', 'OrderController@deleteProduct')->name('deleteProduct');
    Route::get('label/{order}', 'OrderController@label')->name('label');
    Route::get('ticket/{order}', 'OrderController@ticket')->name('ticket');
    Route::get('excel/{order}', 'OrderController@excel')->name('excel');
    Route::get('productsDt/{order}', 'OrderController@productsDt')->name('productsDt');
    Route::get('bill/{order}', 'OrderController@bill')->name('bill');
});

Route::middleware('auth')->name('shipping.')->prefix('shipping')->group(function() {
    Route::get('ordersDt/{shipping}', 'ShippingController@ordersDt')->name('ordersDt');
    Route::get('modalDt/{id}', 'ShippingController@modalDt')->name('modalDt');
	Route::get('edit/{shipping}', 'ShippingController@edit')->name('edit');
    Route::post('edit', 'ShippingController@update')->name('update');
	Route::post('delete/{shipping}', 'ShippingController@delete')->name('delete');
    Route::get('create', 'ShippingController@create')->name('create');
	Route::post('create', 'ShippingController@save')->name('save');
    Route::get('dt', 'ShippingController@dt')->name('dt');
    Route::post('addOrder', 'ShippingController@addOrder')->name('addOrder');
    Route::delete('deleteOrder', 'ShippingController@deleteOrder')->name('deleteOrder');
    Route::get('', 'ShippingController@index')->name('index');
    Route::get('txt/{shipping}', 'ShippingController@txt')->name('txt');
    Route::get('excel/{shipping}', 'ShippingController@excel')->name('excel');
    Route::get('excelBill/{shipping}', 'ShippingController@excelBill')->name('excelBill');
    Route::get('bill/{shipping}', 'ShippingController@bill')->name('bill');
});



