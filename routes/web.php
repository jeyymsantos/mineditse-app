<?php

use App\Http\Controllers\BaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;
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

// Admin Authentication
Route::prefix('admin')->middleware('auth')->group(function () {
    // Suppliers Route
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
});

// Customer Authentication
Route::prefix('customer')->middleware('auth')->group(function () {
    // Customer View
    Route::get('/', [CustomerController::class, 'index']);
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');



