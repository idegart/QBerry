<?php

namespace App\Listeners;

use App\Events\ApiRequestHit;
use App\Services\StatService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleApiRequestHit
{
    private StatService $statService;

    public function __construct()
    {
        $this->statService = app()->make(StatService::class);
    }

    public function handle(ApiRequestHit $event)
    {
        if ($user = $event->user()) {
            $this->statService->incrementUserCount($user);
        }
    }
}
