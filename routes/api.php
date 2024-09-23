<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

Route::resource('products', ProductController::class);
Route::middleware(['auth:api'])->resource('orders', OrderController::class);
Route::middleware(['auth:api'])->resource('users', UserController::class);

Route::fallback(function(){
    return response()->json( ['error'=>1,'message'=>'Not found.'], 404 );
});
