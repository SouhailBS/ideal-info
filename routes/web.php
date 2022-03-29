<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::get('/', [HomeController::class, 'index'])->name("home");
Route::view('/login', 'pages.auth.login')->middleware(RedirectIfAuthenticated::class)->name("login-form");
Route::view('/register', 'pages.auth.register')->middleware(RedirectIfAuthenticated::class)->name("register-form");
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name("login");
Route::post('/auth/register', [LoginController::class, 'register'])->name("register");
Route::get('/products/category/{category}/{slug}', [ProductController::class, 'category'])->name("category-product-listing");
Route::get('/products/{product}/{slug}', [ProductController::class, 'product'])->name("single-product");
Route::middleware('auth:web')->group(function (){
    Route::view('/account', 'pages.account')->name("account");
    Route::get("/auth/logout", [LoginController::class, 'logout'])->name("logout");
});
Route::get('/documents/{file}', function ($file) {
    $path = env('DOLIBARR_PATH') . '/' . $file;

    return response(file_get_contents($path), 200, ['Content-type' => mime_content_type($path)]);
})->where('file', '.*')->name("dolibarr");
