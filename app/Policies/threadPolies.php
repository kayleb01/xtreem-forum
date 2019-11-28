<?php

namespace App\Policies;

use App\User;
use App\thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class threadPolies
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Thread $thread)
    {
        return $thread->user_id === $user_id;
    }
}
