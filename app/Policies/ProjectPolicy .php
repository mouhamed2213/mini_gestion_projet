<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\Response;

class ProjectPolicy 
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool // ou : Response
    {
         dd('Hello from Policy');
        // LA LIGNE CRUCIALE EST CELLE-CI :
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        $allowed = false ; 

        if($user -> id  === $project -> user_id){
            $allowed = true; 
            return $allowed; 
            
        }
        return $allowed;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $projects): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $projects): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $projects): bool
    {
        return false;
    }
}
