<?php

namespace App\Models\Record\Traits\Relationship;
  
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
     
}
