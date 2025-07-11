<?php

use App\Http\Controllers\ProductController;
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
Route::get('products', [ProductController::class, 'getProducts']);
Route::post('products', [ProductController::class, 'addProduct']);
Route::post('products/{id}/update', [ProductController::class, 'updateProduct']);  // Using POST for PUT
Route::delete('products/{id}', [ProductController::class, 'deleteProduct']);  // Using POST for DELETE