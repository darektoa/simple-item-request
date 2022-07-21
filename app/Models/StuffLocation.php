<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StuffLocation extends Model
{
    use HasFactory, softDeletes;

    
    public function stuffs() :HasMany {
        return $this->hasMany(Stuff::class);
    }
}
