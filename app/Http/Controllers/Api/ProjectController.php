<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
 

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd('hello from index');
        // list of project 
        // GET the connected user 
        // liste all project associated with him 
        // return a json  reponse
        return  $request -> user() -> projects;// retun OK 
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
        // dd('hello from store');

    // 1. Validation : plus explicite et le résultat est stocké dans une variable au nom clair.
    $validatedData = $request->validate([
        'title'       => 'required|string|max:45',
        'description' => 'nullable|string|max:255', // Règle plus robuste
    ]);

    // La condition 'if' a été supprimée car elle est implicite.
    // Si on arrive ici, la validation a réussi.

    // 2. Création et Association : votre code était déjà parfait.
    $project = $request->user()->projects()->create($validatedData);

    // 3. Réponse : votre code était déjà parfait.
    // On renvoie le modèle de projet nouvellement créé avec le code de statut 201.
    return response()->json($project, 201);
}


    /**
     * Display the specified resource.
     */
// Votre approche, légèrement corrigée pour être robuste
// L'approche standard
public function show(Project $project)
{
    // Fait tout le travail en une seule ligne :
    // - Appelle la policy
    // - Lève une exception 403 si 'deny'
    // - Continue si 'allow'
    // $this->authorize('view', $project);

    return $project;
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request,  $id)
{
    // 1. Validation avec la syntaxe correcte (méthode avec tableau, plus lisible)
    $validatedData = $request->validate([
        'title'       => ['sometimes', 'required', 'string', 'max:45'],
        'description' => ['sometimes', 'nullable', 'string', 'max:255'],
    ]);

    // handle policies
    $project = new Project();
    
    // $this->authorize('update', $project );

    // 2. Mise à jour du modèle avec les données maintenant correctement validées
    Project::where ('id', $id)->update([

        'title' => "faire du sport",
        'description' => $request->description
    ]);

    // 3. Retourner le modèle mis à jour. Une seule ligne suffit.
    return $request -> user()->projects ;
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete projects 
        $project =  Project :: find ($id);
        $project -> delete();
        
        return response(200); 
    }
}
