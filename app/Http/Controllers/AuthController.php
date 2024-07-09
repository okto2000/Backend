<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Customer;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek admin
        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $token = $admin->createToken('admin-token')->plainTextToken;
            return response()->json(['token' => $token, 'role' => 'admin']);
        }

        // Cek employee
        $employee = Employee::where('email', $credentials['email'])->first();
        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            $token = $employee->createToken('employee-token')->plainTextToken;
            return response()->json(['token' => $token, 'role' => 'employee']);
        }

        // Cek customer
        $customer = Customer::where('email', $credentials['email'])->first();
        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            $token = $customer->createToken('customer-token')->plainTextToken;
            return response()->json(['token' => $token, 'role' => 'customer']);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    // Registers a new customer.
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'notelp' => $request->notelp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Registration successful', 'customer' => $customer], 201);
    }

    // Logout.
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
