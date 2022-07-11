<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stuff extends Model
{
    use HasFactory;

    protected $appends = ['status_name'];

    protected $guarded = ['id'];

    public $statusNames = [
        1 => 'Active',
        2 => 'Inactive',
        3 => 'Empty'
    ];


    public function requests() :BelongsToMany {
        return $this->belongsToMany(StuffRequest::class);
    }


    public function statusName() :Attribute {
        $get = fn() => $this->statusNames[$this->status] ?? 'Unknown';
        
        return Attribute::make(
            get: $get
        );
    }
}
