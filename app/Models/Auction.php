<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'starting_bid', 
        'status',
        'start_time', 
        'end_time',
        'vehicle_id'
    ];

    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function bids() {
        return $this->hasMany('App\Models\Bid');
    }

    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle');
    }
}