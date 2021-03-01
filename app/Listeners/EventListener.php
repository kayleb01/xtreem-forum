<?php

namespace App\Listeners;

use App\Events\UserLikes;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\comment;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(UserLikes $event)
    {

     $event->like->comment
            ->where('user_id', '!=', $event->like->user_id)
            ->each
            ->notify($event->like);
    }
}
