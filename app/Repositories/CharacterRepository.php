<?php

namespace App\Repositories;

use App\Http\Requests\Character\IndexRequest;
use App\Models\Character;
use Illuminate\Database\Eloquent\Builder;

class CharacterRepository
{
    public function index(IndexRequest $request): Builder
    {
        return Character::query()
            ->with(['episodesId', 'quotesId'])
            ->when($request->name(), function (Builder $query, string $name) {
                $query->whereRaw("LOWER(name) like LOWER(?)", "%{$name}%");
            });
    }

    public function random(): Builder
    {
        return Character::query()->inRandomOrder();
    }
}