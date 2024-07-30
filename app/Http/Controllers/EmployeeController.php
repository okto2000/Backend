<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\NewEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends BaseController
{
    // Menampilkan semua employee    
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $employees = Employee::where('name', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($employees);
    }

    // Menambahkan employee baru
    public function store(NewEmployeeRequest $request)
    {

        $employee = Employee::create([
            'name' => $request->name,
            'address' => $request->address,
            'notelp' => $request->notelp,
            'salary' => $request->salary,
            'status' => $request->status,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->baseResponse($employee);
    }

    //Menampilkan detail employee berdasarkan ID
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return $this->baseResponse($employee);
    }

    // Mengupdate data employee berdasarkan ID
    public function update(EditEmployeeRequest $request, $id)
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

        return $this->baseResponse($employee, 'Employee successfully updated');
    }

    //Menghapus employee berdasarkan ID
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee successfully deleted']);
    }
}
