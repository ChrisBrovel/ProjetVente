<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    // 🟢 Liste de toutes les catégories
    public function index()
    {
        return response()->json(Categorie::all());
    }

    // 🟢 Afficher une catégorie avec ses produits
    public function show($id)
    {
        $categorie = Categorie::with('produits')->findOrFail($id);
        return response()->json($categorie);
    }

    // 🟢 Créer une nouvelle catégorie (admin only)
    public function store(Request $request)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $categorie = Categorie::create([
            'nom' => $request->nom,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($categorie, 201);
    }

    // 🟡 Mettre à jour une catégorie (admin only)
    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $categorie = Categorie::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $categorie->update($request->only(['nom', 'parent_id']));

        return response()->json($categorie);
    }

    // 🔴 Supprimer une catégorie (admin only)
    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès']);
    }
}
