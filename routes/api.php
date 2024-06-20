<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

Route::post('/gettoken', [MidtransController::class,'gettoken']);
Route::post('/gettoken-test', function(){
return response()->json(["status"=>"OK"]);
});