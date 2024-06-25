<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    // Menampilkan semua karyawan    
    public function showall()
    {
        $karyawans = Karyawan::all();
        return response()->json(['data' => $karyawans]);
    }

    // Menambahkan karyawan baru
    public function add(Request $request)
    {
        
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'gaji' => 'required|numeric',
            'status' => 'required',
            'email' => 'required|string|email|max:255|unique:tbl_karyawan',
            'password' => 'required|string|min:8',
        ]);

        
        $karyawan = Karyawan::create([
            'username' => $validatedData['username'],
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'notelp' => $validatedData['notelp'],
            'gaji' => $validatedData['gaji'],
            'status' => $validatedData['status'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        
        return response()->json(['data' => $karyawan], 201);
    }

    //Menampilkan detail karyawan berdasarkan ID
    public function show($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);
        return response()->json(['data' => $karyawan]);
    }

    // Mengupdate data karyawan berdasarkan ID
    public function update(Request $request, $id_karyawan)
    {
        $karyawan = Karyawan::find($id_karyawan);

        if (!$karyawan) {
            return response()->json(['message' => 'Karyawan tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'gaji' => 'required|numeric',
            'status' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $karyawan->username = $validatedData['username'];
        $karyawan->nama = $validatedData['nama'];
        $karyawan->alamat = $validatedData['alamat'];
        $karyawan->notelp = $validatedData['notelp'];
        $karyawan->gaji = $validatedData['gaji'];
        $karyawan->status = $validatedData['status'];
        $karyawan->email = $validatedData['email'];
        $karyawan->password = $validatedData['password'];
        $karyawan->save();

        return response()->json(['data' => $karyawan], 200);
    }

    //Menghapus karyawan berdasarkan ID
    public function destroy($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);
        $karyawan->delete();
        return response()->json(['message' => 'Karyawan berhasil dihapus']);
    }
}
