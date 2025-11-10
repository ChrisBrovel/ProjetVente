<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleCommandeController extends Controller
{

     public function index($commande_id)
    {
        return response()->json(ArticleCommande::where('commande_id', $commande_id)->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commande_id' => 'required|exists:commandes,id',
            'produit_id'  => 'required|exists:produits,id',
            'quantite'    => 'required|integer|min:1',
            'prix'    => 'required|numeric|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $item = ArticleCommande::create($request->all());
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = ArticleCommande::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = ArticleCommande::findOrFail($id);
        $item->delete();

        return response()->json(['message'=>'Item deleted']);
    }







}
