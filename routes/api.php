<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\EnsureTokenIsPresent;

//Route auth
Route::post('/register', [AuthController::class, 'registerCustomer']);
Route::post('/login/customer', [AuthController::class, 'loginCustomer']);
Route::post('/login/employee', [AuthController::class, 'loginEmployee']);
// Route::get('/product', [ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    // Route midtrans
    Route::post('/gettoken', [MidtransController::class, 'gettoken']);
    Route::post('/gettoken/${orderId}', [MidtransController::class, 'gettoken']);
    Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification']);
    
    // Route product
    Route::Resource('/products', ProductController::class);

    // Route product
    Route::Resource('/transactions', TransactionController::class);
    Route::get('/transaction/details', [TransactionController::class, 'transactions']);

    // Route admin
    // Route::resource('admin', AdminController::class);

    // Route employee
    Route::Resource('employees', EmployeeController::class);

    // Route categorie
    Route::Resource('categories', CategorieController::class);
    Route::Resource('customers', CustomerController::class);
    Route::get('/stats', [StatsController::class, 'getStats']);
    // Route customer
    // Route::get('/customers', [CustomerController::class, 'index']);
    // Route::put('/customers/{id}', [CustomerController::class, 'update']);
    // Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
