<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;

//Route midtrans
Route::post('/gettoken', [MidtransController::class, 'gettoken']);
Route::post('/gettoken-test', function () {
    return response()->json(["status" => "OK"]);
});

//Route produk
Route::get('/produk', [ProdukController::class, 'showall']);
Route::post('/produk', [ProdukController::class, 'add']);
Route::get('/produk/{id_produk}', [ProdukController::class, 'show']);
Route::put('/produk/{id_produk}', [ProdukController::class, 'update']);
Route::delete('/produk/{id_produk}', [ProdukController::class, 'destroy']);

//Route admin
Route::get('/admin', [AdminController::class, 'showall']);
Route::post('/admin', [AdminController::class, 'add']);
Route::get('/admin/{id_admin}', [AdminController::class, 'show']);
Route::put('/admin/{id_admin}', [AdminController::class, 'update']);
Route::delete('/admin/{id_admin}', [AdminController::class, 'destroy']);

//Route karyawan
Route::get('/karyawan', [KaryawanController::class, 'showall']);
Route::post('/karyawan', [KaryawanController::class, 'add']);
Route::get('/karyawan/{id_karyawan}', [KaryawanController::class, 'show']);
Route::put('/karyawan/{id_karyawan}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{id_karyawan}', [KaryawanController::class, 'destroy']);

//Route kategori
Route::get('/kategori', [KategoriController::class, 'showall']);
Route::post('/kategori', [KategoriController::class, 'add']);
Route::get('/kategori/{id_kategori}', [KategoriController::class, 'show']);
Route::put('/kategori/{id_kategori}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroy']);

//Route auth
Route::post('/register/pelanggan', [AuthController::class, 'registerPelanggan']);

//Route pelanggan
Route::get('/pelanggan', [PelangganController::class, 'showall']);