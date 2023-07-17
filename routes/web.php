<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/dashboard',function(){
    return view('pages.dashboard');
});

    Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Admin'],function(){
    Route::get('dashboard',[DashboardController::class, 'index'])->name('pages.bashboard');
    // Product.............................................................................
    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    // Route::get('products',[ProductController::class, 'index'])->name('pages.product');
    Route::post('create-product',[ProductController::class, 'create'])->name('pages.product.create');
    Route::get('products/delete',[ProductController::class, 'destroy'])->name('pages.product.delete');
});