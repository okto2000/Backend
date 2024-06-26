<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
    // Menampilkan semua admin    
    public function showall()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    // Menambahkan admin baru
    public function add(Request $request)
    {
        
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'nullable|email',
            'password' => 'required|string|min:8'
        ]);

        
        $admin = Admin::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
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
    public function update(Request $request, $id_admin)
    {
        $admin = Admin::find($id_admin);

        if (!$admin) {
            return response()->json(['message' => 'Admin tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'nullable|email',
            'password' => 'required|string|min:8',
        ]);

        $admin->username = $validatedData['username'];
        $admin->email = $validatedData['email'];
        $admin->password = $validatedData['password'];
        $admin->save();

        return response()->json($admin, 200);
    }

    //Menghapus admin berdasarkan ID
    public function destroy($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        $admin->delete();
        return response()->json(['message' => 'Admin berhasil dihapus']);
    }
}
