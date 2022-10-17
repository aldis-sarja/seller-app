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

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store']);
Route::put('/products/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);

Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index']);
Route::get('/clients/{id}', [\App\Http\Controllers\ClientController::class, 'show']);
Route::post('/clients', [\App\Http\Controllers\ClientController::class, 'store']);
Route::put('/clients/{id}', [\App\Http\Controllers\ClientController::class, 'update']);
Route::delete('/clients/{id}', [\App\Http\Controllers\ClientController::class, 'destroy']);

Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'index']);
Route::get('/services/{id}', [\App\Http\Controllers\ServiceController::class, 'show']);
Route::post('/services', [\App\Http\Controllers\ServiceController::class, 'store']);
Route::put('/services/{id}', [\App\Http\Controllers\ServiceController::class, 'update']);
Route::delete('/services/{id}', [\App\Http\Controllers\ServiceController::class, 'destroy']);
