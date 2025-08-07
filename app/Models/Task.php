<?php

namespace App\Models;
use App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
         'title',
         'description',
         'status',
         'due_date',
         'project_id',
    ];

    // task  belong to project
    function project (): BelongTo {
        return $this-> BelongTo(Project::class);
    }
}
