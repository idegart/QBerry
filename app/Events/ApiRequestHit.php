<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ApiRequestHit
{
    use Dispatchable, SerializesModels;

    private ?User $user;
    private Carbon $time;

    public function __construct(?User $user = null)
    {
        $this->user = $user;
        $this->time = now();
    }

    public function user(): ?User
    {
        return $this->user;
    }
}
