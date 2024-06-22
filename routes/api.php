<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProdukController;

Route::post('/gettoken', [MidtransController::class,'gettoken']);
Route::post('/gettoken-test', function(){
return response()->json(["status"=>"OK"]);
});
Route::get('/produk', [ProdukController::class,'index']);
Route::post('/produk', [ProdukController::class,'store']);
Route::post('/produk-test', function(){
    return response()->json(["status"=>"OK"]);
});
Route::get('/produk/{id_produk}', [ProdukController::class,'show']);
Route::put('/produk/{id_produk}', [ProdukController::class,'update']);
Route::delete('/produk/{id}', [ProdukController::class,'destroy']);