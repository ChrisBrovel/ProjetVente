<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'in:client,vendeur,admin'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()->first()
            ], 422);
        }

        // Création de l’utilisateur
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Génération du token Passport
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user'          => $user,
            'message'       => 'Utilisateur enregistré avec succès',
            'access_token'  => $token
        ], 201);
    }



//FONCTION Connexion (login)


 public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'login' => 'required|string', // peut être email ou téléphone
            'password' => 'required|string|min:6',
        ]);

         if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()->first()
            ], 422);
        }
         // Vérification si c'est un email ou un téléphone
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (!Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        $user = Auth::user();


        // Génération du token
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
        'message' => 'Connexion réussie',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer'
        ], 200);
    }
}



