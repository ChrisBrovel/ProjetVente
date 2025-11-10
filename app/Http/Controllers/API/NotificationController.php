<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
   /**
     * Afficher toutes les notifications de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json($notifications, 200);
    }

    /**
     * Créer une nouvelle notification (réservé à l'admin ou aux événements système).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'nullable|string|max:100',
        ]);

        $notification = Notification::create($validated);

        return response()->json([
            'message' => 'Notification créée avec succès',
            'notification' => $notification
        ], 201);
    }

    /**
     * Afficher une notification spécifique.
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        // Vérification : seul le propriétaire ou un admin peut voir
        if (Auth::id() !== $notification->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        return response()->json($notification, 200);
    }

    /**
     * Marquer une notification comme lue.
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if (Auth::id() !== $notification->user_id) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        $notification->update(['lu_le' => now()]);

        return response()->json([
            'message' => 'Notification marquée comme lue',
            'notification' => $notification
        ], 200);
    }

    /**
     * Supprimer une notification.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if (Auth::id() !== $notification->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification supprimée avec succès'], 200);
    } 
    

    
}
