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

Route::get('/', 'ProductController@index');

Route::get('/p/{product}', 'ProductController@show')
    ->name('show_product');

Route::name('manager.')
    ->middleware('can:access-manager')
    ->namespace('Manager')
    ->prefix('manager')
    ->group(function () {
        Route::get('/', 'ProductController@index')
            ->name('list_products');
    
        Route::group(['prefix' => 'products'], function () {
            Route::get('/drafts', 'ProductController@drafts')
                ->name('list_drafts')
                ->middleware('can:drafts,App\Product');
            Route::get('/show/{product}', 'ProductController@show')
                ->name('show_product');
            Route::view('/create', 'manager.create')
                ->name('create_product')
                ->middleware('can:create,App\Product');
            Route::post('/create', 'ProductController@store')
                ->name('store_product')
                ->middleware('can:create,App\Product');
            Route::get('/edit/{product}', 'ProductController@edit')
                ->name('edit_product')
                ->middleware('can:update,product');
            Route::put('/edit/{product}', 'ProductController@update')
                ->name('update_product')
                ->middleware('can:update,product');
            Route::delete('/delete/{product}', 'ProductController@destroy')
                ->name('delete_product')
                ->middleware('can:delete,product');
        });
    });
