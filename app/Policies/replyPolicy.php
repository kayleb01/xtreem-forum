<?php

namespace App\Policies;

use App\User;
use App\comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class replyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *@param Reply $reply
     *@param User $user
     * @return bool
     */
    public function update(User $user, comment $comment)
    {
        return $reply->user_id = $user->id;
    }

    /**
    **@param  User $user
    **@return bool
    **Determine if the login user has the abilty to create
    **/
    public function create(User $user){
        if (! $lastReply = $user->fresh()->lastReply) {
           return true;
        }
        return ! $lastReply->wasJustPublished();
    }
}
