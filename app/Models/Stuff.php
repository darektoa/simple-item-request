<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stuff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function requests() :BelongsToMany {
        return $this->belongsToMany(StuffRequest::class);
    }
}
