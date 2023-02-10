<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Authentication
Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // Suppliers Route
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/suppliers/add', [SupplierController::class, 'AddView']);
    Route::post('/suppliers/add', [SupplierController::class, 'AddSupplier']);
    Route::get('/suppliers/delete/{id}', [SupplierController::class, 'DeleteSupplier']);
    Route::get('/suppliers/edit/{id}', [SupplierController::class, 'ShowSupplier']);
    Route::post('/suppliers/edit/{id}', [SupplierController::class, 'EditSupplier']);

    // Bales Route
    Route::get('/bales', [BaleController::class, 'index']);
    Route::get('/bales/add', [BaleController::class, 'AddView']);
    Route::post('/bales/add', [BaleController::class, 'AddBale']);
    Route::get('/bales/delete/{id}', [BaleController::class, 'DeleteBale']);
    Route::get('/bales/edit/{id}', [BaleController::class, 'ShowBale']);
    Route::post('/bales/edit/{id}', [BaleController::class, 'EditBale']);

    // Category Route
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/add', [CategoryController::class, 'AddView']);
    Route::post('/category/add', [CategoryController::class, 'AddCategory']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'ShowCategory']);
    Route::post('/category/edit/{id}', [CategoryController::class, 'EditCategory']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'DeleteCategory']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/archieve', [ProductController::class, 'archieve']);
    Route::get('/products/restore/{id}', [ProductController::class, 'RestoreProduct']);
    Route::get('/products/restore-all', [ProductController::class, 'RestoreAllProduct']);
    Route::get('/products/view/{id}', [ProductController::class, 'ViewProduct']);
    Route::get('/products/add', [ProductController::class, 'AddView']);
    Route::post('/products/add', [ProductController::class, 'AddProduct']);
    Route::get('/products/edit/{id}', [ProductController::class, 'ShowProduct']);
    Route::post('/products/edit/{id}', [ProductController::class, 'EditProduct']);
    Route::get('/generate-barcode', [ProductController::class, 'ViewBarcode'])->name('generate.barcode');
    Route::get('/products/delete/{id}', [ProductController::class, 'DeleteProduct']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/add', [OrderController::class, 'ShowProducts'])->name('add_orders');
    Route::get('/orders/cart/', [OrderController::class, 'ShowCart']);
    Route::get('/orders/cancelled/', [OrderController::class, 'CancelledOrders']);
    Route::get('/orders/add/{id}', [OrderController::class, 'AddToCart']);
    Route::get('/orders/remove/{id}', [OrderController::class, 'RemoveFromCart']);
    Route::POST('/orders/submit', [OrderController::class, 'CartSubmit']);

    // Invoice
    Route::get('/orders/invoice/{id}', [OrderController::class, 'ViewOrder']);
    Route::GET('/orders/edit/{id}', [OrderController::class, 'EditOrder']);
    Route::POST('/order/update/{id}', [OrderController::class, 'UpdateOrder']);
    Route::get('/orders/delete/{id}', [OrderController::class, 'DeleteOrder']);

    // Invoice Printing
    Route::get('/orders/invoice/{id}/view', [PrintController::class, 'ViewInvoice']);
    Route::get('/orders/invoice/{id}/generate', [PrintController::class, 'GenerateInvoice']);

    // Invoice Payment
    Route::get('/orders/payment/{id}', [PaymentController::class, 'ViewPayment'])->name('view_payment');
    Route::post('/orders/payment/{id}', [PaymentController::class, 'PayOrder']);

    Route::get('/orders/receipts', [PaymentController::class, 'index'])->name('receipts');


    Route::get('/customer/address/{id}', [OrderController::class, 'GetAddress']);

    // Customers
    Route::get('/customers', [CustomerController::class, 'admin_index']);

});

// Customer Authentication
Route::prefix('customer')->middleware(['auth', 'isCustomer'])->group(function () {
    // Customers Route
    Route::get('/', [CustomerController::class, 'index']);

    // Customer Cart
    Route::get('/orders/add/{id}', [OrderController::class, 'AddToCart']);
    Route::get('/orders/checkout', [CartController::class, 'ShowCart']);
    Route::get('/orders/remove/{id}', [CartController::class, 'RemoveFromCart']);
});

// Staff Authentication
Route::prefix('staff')->middleware(['auth', 'isStaff'])->group(function () {
    // Customers Route
    Route::get('/', [StaffController::class, 'index']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/storage/link', function () {
    Artisan::call('storage:link');
});