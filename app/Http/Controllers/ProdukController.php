<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    //Menampilkan semua produk
    public function showall()
    {
        $products = Produk::all();
        return response()->json(['data' => $products]);
    }

    //Menambahkan produk
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'image' => 'nullable|string',
            'id_kategori' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $product = Produk::create([
            'nama_produk' => $validatedData['nama_produk'],
            'image' => $validatedData['image'],
            'id_kategori' => $validatedData['id_kategori'],
            'price' => $validatedData['price']
        ]);

        return response()->json(['data' => $product], 201);
    }

    //Menampilkan produk by ID
    public function show($id_produk)
    {
        $product = Produk::findOrFail($id_produk);
        return response()->json(['data' => $product]);
    }

    //Update a product by ID.
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

    //Deletes a product with the given ID.
    public function destroy($id_produk)
    {
        $product = Produk::findOrFail($id_produk);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
