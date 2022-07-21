<?php

namespace App\Models;

use App\Helpers\RandomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StuffLocation extends Model
{
    use HasFactory, softDeletes;


    protected static function boot() {
        parent::creating(function($data) {
            if($data->code) return;
            $data->code = 'SL-' . RandomHelper::code(3);
        });

        parent::boot();
    }

    
    public function stuffs() :HasMany {
        return $this->hasMany(Stuff::class);
    }
}
