<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- Routes Publiques ---
// Le hall d'entrée de notre application. Pas besoin d'être connecté.
require __DIR__.'/auth.php';


// --- Zone Sécurisée (VIP) ---
// Tout ce qui est ici nécessite un token d'authentification valide.
Route::middleware('auth:sanctum')->group(function () {

    // La route pour récupérer l'utilisateur connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Les routes pour les projets sont maintenant DANS la zone sécurisée
    Route::apiResource('projects', ProjectController::class);

    // Task Routes each task belong to a project projects/{project}/tasks project should be 
    // include in the task url   
    Route::apiResource('projects/{project}/tasks', TaskController::class);

});
