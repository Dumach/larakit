<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    /** @use HasFactory<\Database\Factories\TravelFactory> */
    use HasFactory;

    protected $guarded = [];

    public function destination(){
        return $this->belongsTo(Destination::class);
    }

    public function travel_signups(){
        return $this->hasMany(TravelSignup::class);
    }
}
