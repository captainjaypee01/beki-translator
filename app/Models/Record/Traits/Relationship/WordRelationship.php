<?php

namespace App\Models\Record\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Record\Translate;

/**
 * Class WordRelationship.
 */
trait WordRelationship
{
    public function translates()
    {
        return $this->hasMany(Translate::class);
    }
     
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
