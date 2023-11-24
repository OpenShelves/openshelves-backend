<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/login', function () {
    return response()->json(['error' => 'not logged in'], 401);
})->name('login');

Route::get('/label/{code}', 'App\Http\Controllers\LabelController@createLabel');
Route::get('/label2/{code}', 'App\Http\Controllers\LabelController@createLabel2');
