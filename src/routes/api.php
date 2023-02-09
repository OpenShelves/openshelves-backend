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
Route::get('products/total', 'App\Http\Controllers\ProductController@totalProducts');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('get-details', 'App\Http\Controllers\PassportController@getDetails');
    Route::get('products', 'App\Http\Controllers\ProductController@list');
    Route::get('products/search', 'App\Http\Controllers\ProductController@search');
    Route::post('product', 'App\Http\Controllers\ProductController@store');
    Route::post('productbycode', 'App\Http\Controllers\ProductController@productbycode');
    Route::get('product/{id}', 'App\Http\Controllers\ProductController@productbyid');



    Route::post('warehouse', 'App\Http\Controllers\WarehouseController@store');
    Route::get('warehouse/{id}', 'App\Http\Controllers\WarehouseController@getwarehouse');
    Route::get('warehouses', 'App\Http\Controllers\WarehouseController@getwarehouses');
    Route::delete('warehouse/{id}', 'App\Http\Controllers\WarehouseController@delete');
    
    
    Route::get('warehouseplaces', 'App\Http\Controllers\WarehousePlaceController@list');
    Route::get('warehouseplace/{id}', 'App\Http\Controllers\WarehousePlaceController@getWarehouseById');
    Route::post('warehouseplace', 'App\Http\Controllers\WarehousePlaceController@store');
    Route::delete('warehouseplace/{id}', 'App\Http\Controllers\WarehousePlaceController@delete');
    
    
    Route::post('inventory', 'App\Http\Controllers\InventoryController@store');
    Route::get('inventory/{id}/products', 'App\Http\Controllers\InventoryController@productsByWarehousePlace');
    Route::get('inventory/{id}/warehouseplaces', 'App\Http\Controllers\InventoryController@productsByProductId');

    
});


// Route::middleware('auth:passport')
