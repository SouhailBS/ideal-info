<?php

use App\Http\Controllers\CartController;
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


Route::post('/cart/product/{product}', [CartController::class, 'add'])->name('ajax-add-to-cart');
Route::put('/cart/product', [CartController::class, 'update'])->name('ajax-update-cart');
Route::delete('/cart/delete/{product}', [CartController::class, 'delete'])->name('ajax-delete-from-cart');
