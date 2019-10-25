<?php

namespace App\Models\Record;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record\Traits\Attribute\TranslateAttribute;
use App\Models\Record\Traits\Relationship\TranslateRelationship;

class Translate extends Model
{
    use SoftDeletes,
        TranslateAttribute,
        TranslateRelationship;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $primaryKey  = 'id';
    protected $fillable = [ 
        'id', 
        'name', 
        'status', 
    ];
}
