<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Stuff extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['status_name', 'unit_name'];

    protected $guarded = ['id'];

    public $statusNames = [
        1 => 'Active',
        2 => 'Inactive',
        3 => 'Empty'
    ];

    public $unitNames = [
        1 => 'Pcs',
        2 => 'Box',
        3 => 'Pack',
    ];


    protected static function boot() {
        parent::creating(function($data) {
            if($data->code) return;

            $id = (Stuff::orderByDesc('id')->first()->id ?? 0) + 1;
            $data->code = 'ATK' . Str::padLeft($id, 3, '0');
        });

        parent::boot();
    }


    public function requests() :BelongsToMany {
        return $this->belongsToMany(StuffRequest::class);
    }


    public function statusName() :Attribute {
        $get = fn() => $this->statusNames[$this->status] ?? 'Unknown';
        
        return Attribute::make(
            get: $get
        );
    }


    public function unitName() : Attribute {
        $get = fn() => $this->unitNames[$this->unit] ?? 'Unknown';

        return Attribute::make(
            get: $get
        );
    }
}
