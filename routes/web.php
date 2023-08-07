<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpiredProductController;
use App\Http\Controllers\Admin\OutStockProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DamageController;
use App\Http\Controllers\Admin\CompanyController;

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

Route::get('admin/dashboard', function () {
    return view('pages.dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('pages.bashboard');
    /*
    |--------------------------------------------------------------------------
    | All Categories Routes
    |--------------------------------------------------------------------------
    */
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories-fetchall', [CategoriesController::class, 'fetchAll'])->name('categories.fetchAll');
    Route::post('/categories-store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories-edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/categories-update', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories-delete', [CategoriesController::class, 'delete'])->name('categories.delete');
    /*
    |--------------------------------------------------------------------------
    | All Supplier Routes
    |--------------------------------------------------------------------------
    */
    Route::get('supplier', [SuppliersController::class, 'index'])->name('supplier.index');
    Route::get('/supplier-fetchall', [SuppliersController::class, 'fetchAll'])->name('supplier.fetchAll');
    Route::post('/supplier-store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier-edit', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::post('/supplier-update', [SuppliersController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier-delete', [SuppliersController::class, 'delete'])->name('supplier.delete');
    /*
    |--------------------------------------------------------------------------
    | All Purchase Routes
    |--------------------------------------------------------------------------
    */
    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase-fetchall', [PurchaseController::class, 'fetchAll'])->name('purchase.fetchAll');
    Route::post('/purchase-store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase-edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
    Route::post('/purchase-update', [PurchaseController::class, 'update'])->name('purchase.update');
    Route::delete('/purchase-delete', [PurchaseController::class, 'delete'])->name('purchase.delete');

    Route::get('/purchase-reports', [PurchaseController::class, 'reports'])->name('purchase.reports');
    Route::post('/purchase-reports', [PurchaseController::class, 'generateReport']);
    /*
    |--------------------------------------------------------------------------
    | All Purchase Routes
    |--------------------------------------------------------------------------
    */
    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product-fetchAll', [ProductController::class, 'fetchAll'])->name('product.fetchAll');
    Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product-edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product-update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product-delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('products/outstock', [OutStockProductController::class, 'outstock'])->name('outstock');
    Route::get('products/expired', [ExpiredProductController::class, 'expired'])->name('expired');
    /*
   |--------------------------------------------------------------------------
   | All Sales Routes
   |--------------------------------------------------------------------------
   */
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::post('/sales-store', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales-edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::post('/sales-update', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/sales-delete', [SaleController::class, 'destroy'])->name('sales.delete');

    Route::get('/sales-reports', [SaleController::class, 'reports'])->name('sales.reports');
    Route::post('/sales-reports', [SaleController::class, 'generateReport']);
        /*
   |--------------------------------------------------------------------------
   | All Damage Routes
   |--------------------------------------------------------------------------
   */

   Route::get('/damage',[DamageController::class, 'index'])->name('damage.index');
   Route::post('/damage/store', [DamageController::class, 'store'])->name('damage.store');
   Route::get('/damage/edit', [SaleController::class, 'edit'])->name('damage.edit');
    /*
    |--------------------------------------------------------------------------
    | All Accounts Routes
    |--------------------------------------------------------------------------
    */
    Route::get('accounts', [AccountsController::class, 'index'])->name('accounts.index');
    Route::get('accounts-billing-history', [AccountsController::class, 'BillingHistoryindex'])->name('billinghistory.index');
    Route::get('accounts-other-transaction', [AccountsController::class, 'OtherTransactionIndex'])->name('othertransaction.index');
    Route::get('accounts-transaction-history', [AccountsController::class, 'TransactionHistoryIndex'])->name('transactionhistory.index');
    Route::get('cash-memo', [AccountsController::class, 'CashMemo'])->name('cashmemo.index');
    Route::get('barcode-scanning', [AccountsController::class, 'BarcodeScanning'])->name('barcodescanning.index');



    /*
  |--------------------------------------------------------------------------
  | All Customer Routes
  |--------------------------------------------------------------------------
  */
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');


    /*
  |--------------------------------------------------------------------------
  | All Company Routes
  |--------------------------------------------------------------------------
  */
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
});
