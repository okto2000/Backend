<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function baseResponse( $data ,$message = 'Success'){
        return response()->json([
            'status'=>true, 
            'message'=> $message,
            'data'=> $data]);
    }
}
