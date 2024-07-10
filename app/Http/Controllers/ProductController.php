<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProductRequest;
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
    public function store(NewProductRequest $request)
    {

        $product = Product::create([
            'product_name' => $request['product_name'],
            'image' => $request['image'],
            'id_category' => $request['id_category'],
            'price' => $request['price']
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
    public function update(NewProductRequest $request, $id_produk)
    {
        $product = Product::find($id_produk);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->fill([
            'product_name' => $request['product_name'],
            'image' => $request['image'],
            'id_category' => $request['id_category'],
            'price' => $request['price']
        ])->save();

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
