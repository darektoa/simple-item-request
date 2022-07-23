<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class StuffRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }


    public function stuffs() :BelongsToMany {
        return $this->belongsToMany(Stuff::class)
            ->withPivot('quantity');
    }
}
