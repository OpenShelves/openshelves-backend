<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'App\Http\Controllers\PassportController@login');
Route::post('register', 'App\Http\Controllers\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'App\Http\Controllers\PassportController@getDetails');
    Route::get('products', 'App\Http\Controllers\ProductController@list');
    Route::get('products/search', 'App\Http\Controllers\ProductController@search');
    Route::post('product', 'App\Http\Controllers\ProductController@store');



    Route::post('warehouse', 'App\Http\Controllers\WarehouseController@store');
    Route::get('warehouse/{id}', 'App\Http\Controllers\WarehouseController@getwarehouse');
    Route::get('warehouses', 'App\Http\Controllers\WarehouseController@getwarehouses');
    Route::delete('warehouse/{id}', 'App\Http\Controllers\WarehouseController@delete');
    
    
    Route::get('warehouseplaces', 'App\Http\Controllers\WarehousePlaceController@list');
});


// Route::middleware('auth:passport')
