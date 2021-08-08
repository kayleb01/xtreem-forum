<?php

namespace App\Listeners;

use App\User;
use App\comment;
use App\Events\UserLikes;
use App\Notifications\LikeClicked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikesListener
{

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(UserLikes $event)
    {
     $reply_user = User::where('id', $event->like->user_id)->first();
     if ($reply_user->id != $event->reply->user->id) {
        $event->reply->user->notify(new LikeClicked($event->reply, $reply_user));
     }
    }
}
