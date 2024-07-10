<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCategorieRequest;
use Illuminate\Http\Request;
use App\Models\Categorie;
class CategorieController extends Controller
{
    //Menampilkan semua data categorie
    public function index()
    {
       
        $categories = Categorie::all();

        
        return response()->json($categories);
    }

//Menambahkan categorie
public function store(NewCategorieRequest $request)
{
   
    $categorie = Categorie::create([
        'category_name' => $request['category_name'],
    ]);

   
    return response()->json($categorie, 201);
}

//Menampilkan Categorie by ID
public function show($id_produk)
{
  
    $categorie = Categorie::findOrFail($id_produk);

 
    return response()->json($categorie);
}

//Update a Categorie by ID
public function update(NewCategorieRequest $request, $id_produk)
    {
        $categorie = Categorie::find($id_produk);

     
        if (!$categorie) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
       
        $categorie->fill([
            'category_name' => $request['category_name'],
        ])->save();

     
        return response()->json($categorie, 200);
    }

    //Delete Categorie by ID
public function destroy($id_produk)
{
    $categorie = Categorie::findOrFail($id_produk);

    $categorie->delete();
    return response()->json(['message' => 'Categorie successfully deleted']);
}
}
