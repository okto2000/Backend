<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    //Menampilkan semua produk
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $products = Product::where('product_name', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($products);
    }

    //Menambahkan produk
    public function store(NewProductRequest $request)
    {

        $product = Product::create([
            'product_name' => $request->product_name,
            'image' => $request->image,
            'id_category' => $request->id_category,
            'price' => $request->price,
        ]);

        return $this->baseResponse($product);
    }

    //Menampilkan produk by ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $this->baseResponse($product);
    }

    //Update a product by ID.
    public function update(NewProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->fill([
            'product_name' => $request->product_name,
            'image' => $request->image,
            'id_category' => $request->id_category,
            'price' => $request->price
        ])->save();

        return $this->baseResponse($product);
    }

    //Deletes a product with the given ID.
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted']);
    }
}
