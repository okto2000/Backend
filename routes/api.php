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

//Route midtrans
Route::post('/gettoken', [MidtransController::class, 'gettoken']);
Route::post('/gettoken-test', function () {
    return response()->json(["status" => "OK"]);
});

//Route product
Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

//Route admin
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::get('/admin/{id}', [AdminController::class, 'show']);
Route::put('/admin/{id}', [AdminController::class, 'update']);
Route::delete('/admin/{id}', [AdminController::class, 'destroy']);

//Route employee
Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

//Route categorie
Route::get('/categorie', [CategorieController::class, 'index']);
Route::post('/categorie', [CategorieController::class, 'store']);
Route::get('/categorie/{id}', [CategorieController::class, 'show']);
Route::put('/categorie/{id}', [CategorieController::class, 'update']);
Route::delete('/categorie/{id}', [CategorieController::class, 'destroy']);

//Route auth
Route::post('/register/customer', [AuthController::class, 'registerCustomer']);

//Route customer
Route::get('/customer', [CustomerController::class, 'index']);