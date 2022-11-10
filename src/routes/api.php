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
});


// Route::middleware('auth:passport')
