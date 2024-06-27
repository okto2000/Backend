<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
class CategorieController extends Controller
{
    //Menampilkan semua data categorie
    public function showall()
    {
       
        $categories = Categorie::all();

        
        return response()->json($categories);
    }

//Menambahkan categorie
public function add(Request $request)
{
    
    $validatedData = $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

   
    $categorie = Categorie::create([
        'category_name' => $validatedData['category_name'],
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
public function update(Request $request, $id_produk)
    {
        $categorie = Categorie::find($id_produk);

     
        if (!$categorie) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
       
        $validatedData = $request->validate([
           'category_name' => 'required|string|max:255' 
        ]);

       
        $categorie->category_name = $validatedData['category_name'];
        $categorie->save();

     
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
