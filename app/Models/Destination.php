<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;
    use HasImage;
    use Searchable;

    protected $guarded = [];

    private array $searchable = [
        'country',
        'vehicle',
    ];


    public function created_by(){
        return $this->belongsTo(User::class);
    }

    public function travels(){
        return $this->hasMany(Travel::class);
    }
}
