<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Customer;


class AuthController extends Controller
{
    public function loginEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek employee
        $employee = Employee::where('email', $credentials['email'])->first();
        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            $token = $employee->createToken('employee-token')->plainTextToken;
            return response()->json(['token' => $token,'data'=>$employee, 'role' => $employee->role]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        // Cek customer
        $customer = Customer::where('email', $credentials['email'])->first();
        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            $token = $customer->createToken('customer-token')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    // Registers a new customer.
    public function registerCustomer(RegisterCustomerRequest $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'notelp' => $request->notelp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $customer->createToken('customer-token')->plainTextToken;
        return response()->json(['message' => 'Registration successful', 'customer' => $customer,'token' => $token], 201);
    }

    // Logout.
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        // $token->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
    
    // public function googleLogin(Request $request)
    // {
    //     $googleToken = $request->input('token');
        
    //     try {
    //         $googleUser = Socialite::driver('google')->userFromToken($googleToken);
    //         $email = $googleUser->getEmail();
            
    //         $user = Customer::where('email', $email)->first();
    //         if (!$user) {

    //             return response()->json(['message' => 'User not found'], 404);
    //         }

    //         $token = $user->createToken('web')->plainTextToken;

    //         return response()->json(['token' => $token, 'user' => $user], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Authentication failed', 'error' => $e->getMessage()], 500);
    //     }
    // }
}
