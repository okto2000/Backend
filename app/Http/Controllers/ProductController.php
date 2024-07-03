<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //Menampilkan semua produk
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }

    //Menambahkan produk
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'id_category' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $product = Product::create([
            'product_name' => $validatedData['product_name'],
            'image' => $validatedData['image'],
            'id_category' => $validatedData['id_category'],
            'price' => $validatedData['price']
        ]);

        return response()->json(['data' => $product], 201);
    }

    //Menampilkan produk by ID
    public function show($id_produk)
    {
        $product = Product::findOrFail($id_produk);
        return response()->json(['data' => $product]);
    }

    //Update a product by ID.
    public function update(Request $request, $id_produk)
    {
        $product = Product::find($id_produk);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'id_category' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $product->product_name = $validatedData['product_name'];
        $product->image = $validatedData['image'];
        $product->id_category = $validatedData['id_category'];
        $product->price = $validatedData['price'];
        $product->save();

        return response()->json(['data' => $product], 200);
    }

    //Deletes a product with the given ID.
    public function destroy($id_produk)
    {
        $product = Product::findOrFail($id_produk);
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted']);
    }
}
