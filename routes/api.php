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

// Post Objects (login pending)
Route::post('login', [LoginController::class, 'LoginCustomer']);

Route::get('order/{id}', [LoginController::class, 'GetOrder']);
