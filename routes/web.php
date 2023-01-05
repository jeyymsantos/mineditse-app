<?php

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Suppliers Route
Route::get('/admin/suppliers', [SupplierController::class, 'index']);
Route::get('/admin/suppliers/add', [SupplierController::class, 'add']);
Route::post('/admin/suppliers/add', [SupplierController::class, 'AddSupplier']);
Route::get('/admin/suppliers/delete/{id}', [SupplierController::class, 'DeleteSupplier']);
Route::get('/admin/suppliers/edit/{id}', [SupplierController::class, 'ShowSupplier']);
Route::post('/admin/suppliers/edit/{id}', [SupplierController::class, 'EditSupplier']);