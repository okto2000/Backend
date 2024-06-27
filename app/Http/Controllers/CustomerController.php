<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showall()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }
}
