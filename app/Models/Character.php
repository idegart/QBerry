<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    protected $casts = [
        'occupations' => 'array',
    ];

    protected $hidden = ['pivot'];

    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_character');
    }

    public function episodesId(): BelongsToMany
    {
        return $this->episodes()->select('episodes.id');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function quotesId(): HasMany
    {
        return $this->quotes()->select('quotes.character_id', 'quotes.id');
    }
}
