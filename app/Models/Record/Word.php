<?php

namespace App\Models\Record;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record\Traits\Attribute\WordAttribute;
use App\Models\Record\Traits\Relationship\WordRelationship;

class Word extends Model
{
    use SoftDeletes,
        WordAttribute,
        WordRelationship;
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
