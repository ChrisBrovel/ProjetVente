<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProduitController;
use App\Http\Controllers\API\CommandeController;
use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\SupportController;

// =====================
// Routes publiques
// =====================
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);

// ----- Catégories CRUD -----
        Route::apiResource('categories', CategorieController::class);
        Route::get('/categories', [CategorieController::class, 'index']);

        //  Routes Produits
Route::get('/produits', [ProduitController::class, 'index']);
Route::get('/produits/{id}', [ProduitController::class, 'show']);


// =====================
// Routes authentifiées
// =====================

//Les routes dans le middleware necessite un token 
Route::middleware('auth:api')->group(function () {


//  Routes produits protégées (requièrent un token Passport)

    Route::post('/produits', [ProduitController::class, 'store']);
    Route::put('/produits/{id}', [ProduitController::class, 'update']);
    Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);




    // ----- Profil utilisateur -----
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'profile']);          // Voir profil
        Route::put('/', [UserController::class, 'update']);           // Modifier profil
        Route::post('/change-password', [UserController::class, 'changePassword']); // Changer mdp
    });

    // ----- Notifications -----
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);           // Liste notifications
        Route::post('/', [NotificationController::class, 'store']);         // Créer notification (admin)
        Route::get('/{id}', [NotificationController::class, 'show']);       // Détails notification
        Route::put('/{id}/read', [NotificationController::class, 'markAsRead']); // Marquer comme lu
        Route::delete('/{id}', [NotificationController::class, 'destroy']); // Supprimer notification
    });

    // ----- Déconnexion -----
    Route::post('/logout', function (Request $request) {
        $request->user()->token()->revoke(); // ou currentAccessToken()->delete() si Sanctum
        return response()->json(['message' => 'Successfully logged out']);
    });

    // =====================
    // Commandes utilisateurs
    // =====================
    Route::prefix('commandes')->group(function () {
        Route::post('/', [CommandeController::class, 'store']);      // Créer commande
        Route::get('/', [CommandeController::class, 'myOrders']);    // Voir ses commandes
        Route::get('/{id}', [CommandeController::class, 'showMyOrder']); // Détails commande utilisateur
    });






    // =====================
    // Routes admin
    // =====================
    Route::middleware('can:admin')->group(function () {

        // ----- Produits CRUD -----
        // Route::apiResource('produits', ProduitController::class);

        // ----- Commandes admin -----
        Route::get('admin/commandes', [CommandeController::class, 'index']); // Toutes commandes
        Route::get('admin/commandes/{id}', [CommandeController::class, 'show']); // Commande spécifique
        Route::put('admin/commandes/{id}', [CommandeController::class, 'update']);
        Route::delete('admin/commandes/{id}', [CommandeController::class, 'destroy']);
        Route::put('admin/commandes/{id}/status', [CommandeController::class, 'updateStatus']);

        



        // ----- Support client admin -----
        Route::prefix('support')->group(function () {
            Route::post('{id}/reply', [SupportController::class, 'reply']); // Répondre
            Route::put('{id}', [SupportController::class, 'update']);       // Modifier ticket
            Route::delete('{id}', [SupportController::class, 'destroy']);   // Supprimer ticket
        });
    });
});
















































// // Route::get('/user', function (Request $request) {
// //     return $request->user();
// // })->middleware('auth:api');

// //Mes routes d'authentification (publiques)
// Route::post('/register',[UserAuthController::class,'register']);
// Route::post('/login',[UserAuthController::class,'login']);

// //Route de déconnexion (logout)
// Route::middleware('auth:api')->post('/logout', function (Request $request) {
//     // Révoquer le token actuel
//     $request->user()->token()->revoke();

//     return response()->json([
//         'message' => 'Successfully logged out'
//     ]);
    
// });



// //Mes routes protégées (nécessitent une authentification)
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
//     });


//     // Routes pour la gestion des notifications

// Route::middleware('auth:api')->group(function () {
//     Route::get('/notifications', [NotificationController::class, 'index']);
//     Route::post('/notifications', [NotificationController::class, 'store']); // admin ou système
//     Route::get('/notifications/{id}', [NotificationController::class, 'show']);
//     Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
//     Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
// });


// Route::middleware(['auth:api', 'can:admin'])->group(function () {
//     // Routes produits admin
//     Route::get('/produits', [ProduitController::class, 'index']);
//     Route::get('/produits/{id}', [ProduitController::class, 'show']);
//     Route::post('/produits', [ProduitController::class, 'store']);      // admin
//     Route::put('/produits/{id}', [ProduitController::class, 'update']); // admin
//     Route::delete('/produits/{id}', [ProduitController::class, 'destroy']); // admin
  
   
//     // COMMANDES
//     Route::get('/commandes', [CommandeController::class, 'index']);
//     Route::get('/commandes/{id}', [CommandeController::class, 'show']);
//     Route::post('/commandes', [CommandeController::class, 'store']);
//     Route::put('/commandes/{id}', [CommandeController::class, 'update']);
//     Route::delete('/commandes/{id}', [CommandeController::class, 'destroy']);
//     Route::put('/commandes/{id}/status', [CommandeController::class, 'updateStatus']);
   
   
   
   
//     // Routes catégories admin
//     Route::post('/categories', [CategorieController::class, 'store']);
//     Route::put('/categories/{id}', [CategorieController::class, 'update']);
//     Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);

//     // Modifier le statut d’une commande
   

//     // Support client admin
//     Route::post('/support/{id}/reply', [SupportController::class, 'reply']);
//     Route::put('/support/{id}', [SupportController::class, 'update']);
//     Route::delete('/support/{id}', [SupportController::class, 'destroy']);
// });

// //Routes utilisateur (profil, update et changement de mdp)
// Route::middleware('auth:api')->group(function () {
//     // Récupérer le profil (GET)
//     Route::get('/user', [UserController::class, 'profile']);

//     // Modifier le profil (PUT)
//     Route::put('/user', [UserController::class, 'update']);

//     // Changer le mot de passe (POST)
//     Route::post('/user/change-password', [UserController::class, 'changePassword']);
// });
