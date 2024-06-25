<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class AuthController extends Controller
{
    public function registerPelanggan(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_pelanggan',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $pelanggan = Pelanggan::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Registration successful', 'pelanggan' => $pelanggan], 201);
    }
}
