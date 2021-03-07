<?php

namespace App\Repositories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;

class QuoteRepository
{
    public function random(): Builder
    {
        return Quote::query()->inRandomOrder();
    }

    public function randomByAuthor(string $authorName): Builder
    {
        return $this->random()->whereHas('character', function (Builder $query) use ($authorName) {
            $query->where('name', '=', $authorName);
        });
    }
}