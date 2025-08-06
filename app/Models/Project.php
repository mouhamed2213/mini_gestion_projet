<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
