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

//Route auth
Route::post('/register', [AuthController::class, 'registerCustomer']);
Route::post('/login/customer', [AuthController::class, 'loginCustomer']);
Route::post('/login/employee', [AuthController::class, 'loginEmployee']);
Route::get('/product', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    
    // Route midtrans
    Route::post('/gettoken', [MidtransController::class, 'gettoken']);

    // Route product
    Route::resource('product', ProductController::class);

    // Route admin
    // Route::resource('admin', AdminController::class);
    // Uncomment above line if AdminController is a resource controller

    // Route employee
    Route::resource('employee', EmployeeController::class);

    // Route categorie
    Route::resource('categorie', CategorieController::class);

    // Route customer
    Route::get('/customer', [CustomerController::class, 'index']);

    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});