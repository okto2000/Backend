<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Menampilkan semua employee    
    public function showall()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Menambahkan employee baru
    public function add(Request $request)
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
    public function show($id_employee)
    {
        $employee = Employee::findOrFail($id_employee);
        return response()->json(['data' => $employee]);
    }

    // Mengupdate data employee berdasarkan ID
    public function update(Request $request, $id_employee)
    {
        $employee = Employee::find($id_employee);

        if (!$employee) {
            return response()->json(['message' => 'Employee tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'status' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $employee->name = $validatedData['name'];
        $employee->address = $validatedData['address'];
        $employee->notelp = $validatedData['notelp'];
        $employee->salary = $validatedData['salary'];
        $employee->status = $validatedData['status'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($validatedData['password']);
        $employee->save();

        return response()->json(['message' => 'Employee berhasil diupdate','data' => $employee], 200);
    }

    //Menghapus employee berdasarkan ID
    public function destroy($id_employee)
    {
        $employee = Employee::findOrFail($id_employee);
        $employee->delete();
        return response()->json(['message' => 'Employee successfully deleted']);
    }
    
}
