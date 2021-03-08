<?php

namespace App\Services;

use App\Models\User;

class StatService
{
    public function incrementUserCount(User $user)
    {
        $this->incrementTotalCount();

        return cache()->increment($this->userKey($user));
    }

    public function userCount(User $user)
    {
        return cache()->get($this->userKey($user));
    }

    public function incrementTotalCount()
    {
        return cache()->increment('api-total-requests');
    }

    public function totalCount()
    {
        return cache()->get('api-total-requests');
    }

    protected function userKey(User $user): string
    {
        return 'api:users:' . $user->getKey();
    }
}