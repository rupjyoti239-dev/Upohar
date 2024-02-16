<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





// MainController
Route::get('/', [MainController::class, 'home'])->name('user.home');
Route::get('/shop', [MainController::class, 'shop'])->name('user.shop');
Route::get('/login', [MainController::class, 'login'])->name('user.login');
Route::get('/register', [MainController::class, 'register'])->name('user.register');
Route::get('/logout', [MainController::class, 'logout'])->name('user.logout');
Route::get('/checkout', [MainController::class, 'checkout'])->name('user.checkout');






// product details page
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.details');




// addToCart
Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');



// AuthController
Route::post('/login', [AuthController::class, 'login'])->name('user.login.post');
Route::post('/register', [AuthController::class, 'register'])->name('user.register.post');
