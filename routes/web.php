<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('products/category/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('products/single-product/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('products/shop', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');
Route::post('products/addcart', [App\Http\Controllers\Products\ProductsController::class, 'addcart'])->name('products.addcart');
Route::get('products/cart', [App\Http\Controllers\Products\ProductsController::class, 'cart'])->name('products.cart')->middleware('auth:web');
Route::get('products/delete-cart/{id}', [App\Http\Controllers\Products\ProductsController::class, 'deleteFromCart'])->name('products.cart.delete');

Route::post('products/prepare-checkout', [App\Http\Controllers\Products\ProductsController::class, 'PrepareCheckout'])->name('products.prepare.checkout');
Route::get('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'checkout'])->name('products.checkout');
Route::post('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'processCheckout'])->name('products.process.checkout');
Route::post('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'processCheckout'])->name('products.process.checkout');
Route::get('products/pay', [App\Http\Controllers\Products\ProductsController::class, 'pay'])->name('products.pay');


//users pages

Route::get('users/my-orders', [App\Http\Controllers\Users\UsersController::class, 'myOrders'])->name('users.orders')->middleware('auth:web');

//admin panel
Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.auth');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => '/admin','middleware' => 'auth:admin'],function() {
    Route::get('index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');
    Route::get('all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'displayAdmins'])->name('admins.all');
    Route::get('all-categories', [App\Http\Controllers\Admins\AdminsController::class, 'displayCategories'])->name('categores.all');
    Route::get('all-products', [App\Http\Controllers\Admins\AdminsController::class, 'displayProducts'])->name('products.all');

});