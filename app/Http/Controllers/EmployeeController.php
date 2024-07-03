<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Menampilkan semua employee    
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Menambahkan employee baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'salary' => 'required|numeric|not_in:0',
            'status' => 'required',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:8',
        ]);

        $employee = Employee::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'notelp' => $validatedData['notelp'],
            'salary' => $validatedData['salary'],
            'status' => $validatedData['status'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json($employee, 201);
    }

    //Menampilkan detail employee berdasarkan ID
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json(['data' => $employee]);
    }

    // Mengupdate data employee berdasarkan ID
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'status' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $employee->fill([
            'name' => $request->name,
            'address' => $request->address,
            'notelp' => $request->notelp,
            'salary' => $request->salary,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->save();

        return response()->json(['message' => 'Employee successfully updated', 'data' => $employee], 200);
    }

    //Menghapus employee berdasarkan ID
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee successfully deleted']);
    }
}
