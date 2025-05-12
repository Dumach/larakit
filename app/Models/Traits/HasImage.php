<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function imageUrl(): Attribute
    {
        return Attribute::get(fn () =>
            $this->image
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/215x160'
        );
    }
}
