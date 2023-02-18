<?php

use App\Http\Controllers\API\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// General or Bulk Objects
Route::get('customers', [LoginController::class, 'GetCustomers']);
Route::get('products', [LoginController::class, 'GetProducts']);

// Post Objects
Route::post('login', [LoginController::class, 'LoginCustomer']);
Route::post('create', [LoginController::class, 'CreateCustomer']);
Route::post('edit', [LoginController::class, 'EditCustomer']);
Route::post('deactivate', [LoginController::class, 'DeactivateCustomer']);
Route::post('order', [LoginController::class, 'GetOrder']);
