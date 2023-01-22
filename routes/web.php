<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
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

    // Category Route
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/add', [CategoryController::class, 'AddView']);
    Route::post('/category/add', [CategoryController::class, 'AddCategory']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/add', [ProductController::class, 'AddView']);
    Route::post('/products/add', [ProductController::class, 'AddProduct']);
});

// Customer Authentication
Route::prefix('customer')->middleware(['auth', 'isCustomer'])->group(function () {
    // Customers Route
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/trial', function () {
        return view('customers.trial');
    });
});

// Staff Authentication
Route::prefix('staff')->middleware(['auth', 'isStaff'])->group(function () {
    // Customers Route
    Route::get('/', [StaffController::class, 'index']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
