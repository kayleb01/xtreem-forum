<?php

namespace App\Listeners;

use App\Events\ThreadRecievedNewReply;

class notifySubscriber
{
    /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply $event
     * @return void
     */
    public function handle(ThreadRecievedNewReply $event)
    {
        $event->comment->thread->subscription
            ->where('user_id', '!=', $event->comment->user_id)
            ->each
            ->notify($event->comment);
    }
}
