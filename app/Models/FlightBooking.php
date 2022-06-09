<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'airlines','category','travel_place','price','arrival','departure'];
    
    public function flightBooking() {
        return $this->belongsTo('App\Models\User');
    }
}
