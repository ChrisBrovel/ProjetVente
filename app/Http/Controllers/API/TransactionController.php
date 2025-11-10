<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    
 public function index(Request $request)
    {
        return response()->json($request->user()->transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commande_id' => 'required|exists:commandes,id',
            'montant'   => 'required|numeric',
            'methode' => 'required|string |in:carte_bancaire,liquide, mobile_money',
            'status'   => 'required|string|in:en_attente,reussi,echoue',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'commande_id' => $request->commande_id,
            'montant'   => $request->montant,
            'methode' => $request->methode,
            'status'   => $request->status,
        ]);

        return response()->json($transaction, 201);
    }







}
