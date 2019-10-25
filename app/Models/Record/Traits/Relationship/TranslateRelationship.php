<?php

namespace App\Models\Record\Traits\Relationship;

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
     
}
