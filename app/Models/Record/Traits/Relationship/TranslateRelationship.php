<?php

namespace App\Models\Record\Traits\Relationship;

use App\Models\Auth\User;
use App\Record\Word;

/**
 * Class TranslateRelationship.
 */
trait TranslateRelationship
{
    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
     
}
