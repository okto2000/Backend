<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCategorieRequest;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Routing\Controllers\Middleware;

class CategorieController extends BaseController
{

    //Menampilkan semua data categorie
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $categories = Categorie::where('category_name', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($categories);
    }

    //Menambahkan categorie
    public function store(NewCategorieRequest $request)
    {

        $categorie = Categorie::create([
            'category_name' => $request->category_name,
        ]);


        return $this->baseResponse($categorie, 'Categorie successfully created');
    }

    //Menampilkan Categorie by ID
    public function show($id_produk)
    {

        $categorie = Categorie::findOrFail($id_produk);

        return $this->baseResponse($categorie);
    }

    //Update a Categorie by ID
    public function update(NewCategorieRequest $request, $id)
    {
        $categorie = Categorie::find($id);


        if (!$categorie) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $categorie->fill([
            'category_name' => $request->category_name,
        ])->save();


        return $this->baseResponse($categorie, 'Categorie successfully updated');
    }

    //Delete Categorie by ID
    public function destroy($id_produk)
    {
        $categorie = Categorie::findOrFail($id_produk);

        $categorie->delete();
        return response()->json(['message' => 'Categorie successfully deleted']);
    }
}
