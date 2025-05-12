<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSignup extends Model
{
    /** @use HasFactory<\Database\Factories\TravelSignupFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function travel(){
        return $this->belongsTo(Travel::class);
    }
}
