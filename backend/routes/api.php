<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/gettoken',[MidtransController::class,'gettoken']);
Route::post('/gettoken-test',function () {
    return response()->json(["status"=>"OK"]);
});
