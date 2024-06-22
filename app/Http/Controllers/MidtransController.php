<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Services\CreateSnapTokenService;

class MidtransController extends Controller
{
    public function gettoken(Request $request)
    {
        
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
