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

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store']);

Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index']);

