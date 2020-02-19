<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'Api',
    'middleware' => ['auth:api', 'json.response'],
], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::group([
        'namespace' => 'Api',
    ], function () {
        Route::group([
            'namespace' => 'v1',
            'prefix' => 'v1',
            'middleware' => 'json.response'
        ], function () {
            Route::post('/register', 'AuthController@register')->name('register');
            Route::post('/login', 'AuthController@login')->name('login');
            Route::group([
                'prefix' => 'categories',
                'as'=>'categories.'
            ], function () {
                Route::get('/', 'CategoryController@index')->name('categories');
                Route::get('/list', 'CategoryController@list')->name('list');
            });
            Route::group([
                'prefix' => 'products',
                'as'=>'products.'
            ], function () {
                Route::get('/', 'ProductController@index')->name('products');
                Route::post('/get-by-ids', 'ProductController@getByIds')->name('getByIds');
            });
    });
});
