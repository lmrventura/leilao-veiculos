<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function optionals()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_optional', 'optional_id', 'vehicle_id');
    }
}
