<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $customers = Customer::where('name', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($customers);
    }

    public function destroy(Request $request, $id)
    {
        $customer = Customer::findOrFail($request->id);
        $customer->delete();
        return $this->baseResponse($customer, 'Customer successfully deleted');
    }
}
