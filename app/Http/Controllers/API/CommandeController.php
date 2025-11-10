<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommandeController extends Controller
{
     public function index(Request $request)
    {
       $commandes = $request->user()->commandes()->with('articles')->paginate(20);
return response()->json($commandes);

    }

    public function show($id)
    {
        $commande = Commande::with('articles')->findOrFail($id);
        return response()->json($commande);
    }

    public function store(Request $request)
    {
        //  créer commande à partir du panier 
        $validator = Validator::make($request->all(), [
            'Montant_total' => 'required|numeric',
            'addresse_livraison' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $commande = Commande::create([
            'user_id' => $request->user()->id,
            'status'  => 'en_attente',
            'moyen_de_payement' => 'carte_bancaire',
            'Montant_total'   => $request->Montant_total,
            'addresse_livraison' => $request->addresse_livraison,
            'date_commande' => now(),
        ]);

        return response()->json($commande, 201);
    }

    public function updateStatus(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message'=>'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:en_attente,en_cours,livre,annule',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $commande = Commande::findOrFail($id);
        $commande->status = $request->status;
        $commande->save();

        return response()->json($commande);
    }
}
