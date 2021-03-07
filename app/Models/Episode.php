<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'episode_character');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }
}
