<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewAdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan semua admin    
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    // Menambahkan admin baru
    public function store(NewAdminRequest $request)
    {
        
        $admin = Admin::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        
        return response()->json($admin, 201);
    }

    //Menampilkan detail admin berdasarkan ID
    public function show($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        return response()->json(['data' => $admin]);
    }

    // Mengupdate data admin berdasarkan ID
    public function update(NewAdminRequest $request, $id_admin)
    {
        $admin = Admin::find($id_admin);

        if (!$admin) {
            return response()->json(['message' => 'Admin tidak ditemukan'], 404);
        }

        $admin->fill([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ])->save();

        return response()->json($admin, 200);
    }

    //Menghapus admin berdasarkan ID
    public function destroy($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        $admin->delete();
        return response()->json(['message' => 'Admin successfully deleted']);
    }
}
