<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $customers = Customer::where('name', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($customers);
    }
    public function update(EditCustomerRequest $request,  $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->fill($request->all())->save();

        return $this->baseResponse($customer, 'Customer successfully updated');
    }

    public function destroy(Request $request, $id)
    {
        $customer = Customer::findOrFail($request->id);
        $customer->delete();
        return $this->baseResponse($customer, 'Customer successfully deleted');
    }
}
