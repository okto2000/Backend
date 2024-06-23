<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
class KategoriController extends Controller
{
    public function index()
    {
       
        $kategori = Kategori::all();

        
        return response()->json(['data' => $kategori]);
    }

public function add(Request $request)
{
    
    $validatedData = $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

   
    $kategori = Kategori::create([
        'nama_kategori' => $validatedData['nama_kategori'],
    ]);

   
    return response()->json(['data' => $kategori], 201);
}

public function show($id_produk)
{
  
    $kategori = Kategori::findOrFail($id_produk);

 
    return response()->json(['data' => $kategori]);
}

public function update(Request $request, $id_produk)
    {
        $kategori = Kategori::find($id_produk);

     
        if (!$kategori) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
       
        $validatedData = $request->validate([
           'nama_kategori' => 'required|string|max:255' 
        ]);

       
        $kategori->nama_kategori = $validatedData['nama_kategori'];
        $kategori->save();

     
        return response()->json(['data' => $kategori], 200);
    }
public function destroy($id_produk)
{
    $kategori = Kategori::findOrFail($id_produk);

    $kategori->delete();
}
}
