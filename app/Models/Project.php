<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use  App\Models\Task;


class Project extends Model

{

    protected $fillable = [
        'title',
        'description'
    ];
    
    // relation project belong to user
    function owner() : belongsTo  {
        return $this -> belongsTo (User::class, 'user_id');
    }

    // a prject has many task 
    function tasks (): HasMany {
        return $this-> HasMany (Task::class , 'project_id');
    }
}
