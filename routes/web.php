<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->where('id','[0-9]+');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->where('id','[0-9]+');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->where('id','[0-9]+');
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update')->where('id','[0-9]+');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->where('id','[0-9]+');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware(['auth']);
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware(['auth']);
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware(['auth']);
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->where('id','[0-9]+')->middleware(['auth']);
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit')->where('id','[0-9]+')->middleware(['auth']);
// Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update')->where('id','[0-9]+')->middleware(['auth']);
Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('orders.update')->where('id','[0-9]+')->middleware(['auth']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy')->where('id','[0-9]+')->middleware(['auth']);
Route::get('/orders/pdf/{id}', [OrderController::class, 'pdf'])->name('orders.pdf')->where('id','[0-9]+')->middleware(['auth']);

Route::get('/cart/show', [CartController::class, 'show'])->name('cart.show');
Route::post('/add-to-cart', [CartController::class, 'addProduct'])->name('cart.add.product');
Route::post('/update-cart', [CartController::class, 'updateProduct'])->name('cart.update.product');

Route::get('/dashboard', [UserController::class, 'index'])->name('users.dashboard')->middleware(['auth']);
Route::get('/profile', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth']);
Route::post('/profile', [UserController::class, 'update'])->name('users.update')->middleware(['auth']);
// Route::patch('/profile', [UserController::class, 'update'])->name('users.update')->middleware(['auth']);

require __DIR__.'/auth.php';
