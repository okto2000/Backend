<?php

namespace App\Http\Controllers;

use App\Services\CreateSnapTokenService;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function gettoken(Request $request)
    {
        //return response()->json(["status"=>"OK"]);
        $request->validate(
            [
                "number"=>"required",
                "total_price"=>"required"
            ]
        );
        $midtrans = new CreateSnapTokenService($request);
        $snapToken = $midtrans->getSnapToken();
        return response()->json(["token"=>$snapToken]);
    }
}
