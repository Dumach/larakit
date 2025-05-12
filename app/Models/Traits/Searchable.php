<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, string $searchBy, string|array $search)
    {
        $search = explode(' ', (string)$search);

        $query->where(function (Builder $query) use ($search, $searchBy) {
            foreach ($search as $word) {

                foreach ($this->searchable as $column) {
                    if (strtolower($searchBy) == strtolower($column)) {
                        $query->orWhere($column, 'LIKE', '%' . $word . '%');
                    }
                }


                // if (strtolower($searchBy) === 'task.name') {
                //     $query->orWhereHas('tasks', function ($taskQuery) use ($word) {
                //         $taskQuery->where('name', 'LIKE', '%' . $word . '%');
                //     });
                // }
            }
        });
    }
}
