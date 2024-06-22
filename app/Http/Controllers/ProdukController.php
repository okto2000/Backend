<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;

class ProdukController extends Controller
{
    public function index()
{
    $products = produk::all();
    return response()->json(['data' => $products]);
}

public function store(Request $request)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'nama_produk' => 'required|string|max:255',
        'image' => 'nullable|string',
        'id_kategori' => 'required|integer',
        'price' => 'required|numeric'
    ]);

    // Membuat produk baru
    $product = produk::create([
        'nama_produk' => $validatedData['nama_produk'],
        'image' => $validatedData['image'],
        'id_kategori' => $validatedData['id_kategori'],
        'price' => $validatedData['price']
    ]);

    // Mengembalikan respons dengan produk yang baru dibuat
    return response()->json(['data' => $product], 201);
}

public function show($id_produk)
{
    $product = produk::findOrFail($id_produk);
    return response()->json(['data' => $product]);
}

public function update(Request $request, $id_produk)
    {
        $product = Produk::find($id_produk);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
           'nama_produk' => 'required|string|max:255',
        'image' => 'nullable|string',
        'id_kategori' => 'required|integer',
        'price' => 'required|numeric'
        ]);

        $product->nama_produk = $validatedData['nama_produk'];
        $product->image = $validatedData['image'];
        $product->id_kategori = $validatedData['id_kategori'];
        $product->price = $validatedData['price'];
        $product->save();

        return response()->json(['data' => $product], 200);
    }
public function destroy($id_produk)
{
    $product = produk::findOrFail($id_produk);
    $product->delete();
    return response()->json(['message' => 'Product deleted']);
}

}
