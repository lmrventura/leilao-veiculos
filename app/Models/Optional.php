<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
    use HasFactory;

    public function optionals()
    {
        return $this->belongsToMany(Optional::class, 'vehicle_optional');
    }
}
