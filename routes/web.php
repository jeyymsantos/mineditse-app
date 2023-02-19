<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
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
})->name('main');

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

    // Receipts
    Route::get('/orders/receipts', [PaymentController::class, 'index'])->name('receipts');
    Route::get('/orders/receipt/{id}', [PaymentController::class, 'ViewReceipt'])->name('view_receipt');
    Route::get('/orders/receipt/{id}/view', [PrintController::class, 'Receipt'])->name('receipt');
    Route::get('/orders/receipt/{id}/generate', [PrintController::class, 'GenerateReceipt']);

    Route::get('/customer/address/{id}', [OrderController::class, 'GetAddress']);

    // Customers
    Route::get('/customers', [CustomerController::class, 'admin_index'])->name('admin_customers');
    Route::get('/customers/archive', [CustomerController::class, 'admin_archive'])->name('archive');
    Route::get('/customers/reactivate/{id}', [CustomerController::class, 'admin_reactivate']);
    Route::get('/customers/deactivate/{id}', [CustomerController::class, 'admin_deactivate']);
    Route::get('/customers/view/{id}', [CustomerController::class, 'admin_view_customer']);
    Route::get('/customers/edit/{id}', [CustomerController::class, 'admin_edit_customer']);
    Route::post('/customers/edit/{id}', [CustomerController::class, 'admin_save_customer']);

    // Admin Side
    Route::get('/profile', [AdminController::class, 'ViewProfile'])->name('admin_profile');
    Route::post('/settings/update_password', [AdminController::class, 'UpdatePassword']);
});

// Customer Authentication
Route::prefix('customer')->middleware(['auth', 'isCustomer'])->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer_home');
    Route::get('/profile', [CustomerController::class, 'ViewProfile'])->name('view_profile');
    Route::get('/deactivate', [CustomerController::class, 'DeactivateCustomer'])->name('deactivate');
    Route::post('/profile/edit', [CustomerController::class, 'EditProfile']);

    Route::get('/order/confirm/{id}', [CustomerController::class, 'ConfirmOrder']);
    Route::get('/settings', [CustomerController::class, 'Settings'])->name('settings');
    Route::post('/settings/update_password', [CustomerController::class, 'UpdatePassword'])->name('update_pass');
    Route::get('/transactions', [CustomerController::class, 'ViewTransactions']);

    // Receipt & Invoice
    Route::get('/orders/invoice/{id}/view', [PrintController::class, 'InvoiceCustomer_View'])->name("customer_invoice");

    // Customer Cart
    Route::get('/orders/add/{id}', [OrderController::class, 'AddToCart']);
    Route::get('/orders/checkout', [CartController::class, 'ShowCart']);
    Route::post('/cart/submit', [CustomerController::class, 'CartSubmit']);
    Route::get('/orders/remove/{id}', [CartController::class, 'RemoveFromCart']);
});

// Staff Authentication
Route::prefix('staff')->middleware(['auth', 'isStaff'])->group(function () {
    Route::get('/', [StaffController::class, 'index']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/register_try', function () {
    return view('auth.register_try');
});

Route::get('/storage/link', function () {
    Artisan::call('storage:link');
});


// Inquiry
Route::post('/inquiry/submit', [InquiryController::class, 'SubmitInquiry']);


