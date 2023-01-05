<?php

use App\Http\Controllers\BaleController;
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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Suppliers Route
Route::get('/admin/suppliers', [SupplierController::class, 'index']);
Route::get('/admin/suppliers/add', [SupplierController::class, 'AddView']);
Route::post('/admin/suppliers/add', [SupplierController::class, 'AddSupplier']);
Route::get('/admin/suppliers/delete/{id}', [SupplierController::class, 'DeleteSupplier']);
Route::get('/admin/suppliers/edit/{id}', [SupplierController::class, 'ShowSupplier']);
Route::post('/admin/suppliers/edit/{id}', [SupplierController::class, 'EditSupplier']);

// Bales Route
Route::get('/admin/bales', [BaleController::class, 'index']);
Route::get('/admin/bales/add', [BaleController::class, 'AddView']);
Route::post('/admin/bales/add', [BaleController::class, 'AddBale']);


// Customer View
Route::get('/home', [BaleController::class, 'index']);