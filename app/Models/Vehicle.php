<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $casts = [
        'optionals' => 'array'
    ];

    protected $guarded = [];

    public function auction() {
        return $this->hasOne('App\Models\Auction'); 
        /**
         * belongsToOne
         * The auctions table should have the vehicle_id as a foreign key to indicate which vehicle is associated with the auction.
         * The vehicles table does not need an auction_id field because the Auction model belongs to the Vehicle, not the other way around.
         */
    }
}
