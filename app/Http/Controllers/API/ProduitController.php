<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Afficher tous les produits
     */
    public function index(Request $request)
{
    // On prépare la requête avec les relations
    $query = Produit::with(['categorie', 'vendeur']);

    // ✅ Si un paramètre de catégorie est passé dans l'URL (ex: /api/produits?categorie_id=3)
    if ($request->has('categorie_id')) {
        $query->where('categorie_id', $request->categorie_id);
    }

    $produits = $query->get();

    return response()->json([
        'success' => true,
        'data' => $produits
    ]);
}

    /**
     * Afficher un produit par ID
     */
    public function show($id)
    {
        $produit = Produit::with(['categorie', 'vendeur'])->find($id);

        if (!$produit) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $produit
        ]);
    }

    /**
     * Créer un produit
     */
    public function store(Request $request)
    {
        // Vérification des permissions (admin ou vendeur connecté)
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'titre'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'required|numeric',
            'quantite'     => 'required|integer|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required|exists:categories,id',
            'vendeur_id'   => 'nullable|exists:users,id', // ✅ vendeur facultatif
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Upload image si présente
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $data['image'] = $path;
        }

        $produit = Produit::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produit créé avec succès',
            'data' => $produit
        ], 201);
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $produit = Produit::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'titre'        => 'sometimes|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'sometimes|numeric',
            'quantite'     => 'sometimes|integer|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'sometimes|exists:categories,id',
            'vendeur_id'   => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        // Gestion du changement d'image
        if ($request->hasFile('image')) {
            if ($produit->image && Storage::disk('public')->exists($produit->image)) {
                Storage::disk('public')->delete($produit->image);
            }

            $path = $request->file('image')->store('produits', 'public');
            $data['image'] = $path;
        }

        $produit->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Produit mis à jour avec succès',
            'data' => $produit
        ]);
    }

    /**
     * Supprimer un produit
     */
    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $produit = Produit::findOrFail($id);

        if ($produit->image && Storage::disk('public')->exists($produit->image)) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produit supprimé avec succès'
        ]);
    }
}
