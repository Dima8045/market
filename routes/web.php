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
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth', 'role:super-admin,admin,editor']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
        Route::get('/', 'CouponController@index')->name('index');
        Route::get('/create', 'CouponController@create')->name('create');
        Route::post('/store', 'CouponController@store')->name('store');
        Route::post('/edit', 'CouponController@edit')->name('edit');
        Route::post('/destroy', 'CouponController@destroy')->name('destroy');
        Route::get('/generate-code', 'CouponController@generateCode')->name('generateCode');
    });
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

