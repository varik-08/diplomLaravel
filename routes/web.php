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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
    'namespace' => 'Admin',
], function () {

    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');

    Route::group([
        'as' => 'orders.',
    ], function () {
        Route::get('orders', 'OrderController@orders')->name('index');
        Route::get('ordersShow/{order}', 'OrderController@ordersShow')->name('show');
    });
});

Route::group([
    'as' => 'basket.',
], function () {
    Route::get('basketAdd/{product}', 'UserController@basketAdd')->name('add');

    Route::group([
        'middleware' => 'emptyBasket',
    ], function () {
        Route::get('basketShow', 'UserController@basketShow')->name('show');
        Route::get('basketRemove/{product}', 'UserController@basketRemove')->name('remove');
        Route::get('basketPlace', 'UserController@basketPlace')->name('place');
        Route::post('basketAccept', 'UserController@basketAccept')->name('accept');
    });
});


Route::get('reset', 'UserController@reset')->name('reset');
Route::get('/', 'FaceController@productShowUser')->name('index');
Route::get('categories', 'FaceController@categoryShowUser')->name('categories');
Route::get('{codeCategory}/{codeProduct}', 'FaceController@product')->name('product');
Route::get('{codeCategory}', 'FaceController@category')->name('category');




