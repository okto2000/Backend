<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewEmployeeRequest;
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
    public function store(NewEmployeeRequest $request)
    {

        $employee = Employee::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'notelp' => $request['notelp'],
            'salary' => $request['salary'],
            'status' => $request['status'],
            'role' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
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
    public function update(NewEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->fill([
            'name' => $request->name,
            'address' => $request->address,
            'notelp' => $request->notelp,
            'salary' => $request->salary,
            'status' => $request->status,
            'role' => $request->role,
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
