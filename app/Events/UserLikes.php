<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class UserLikes
{
   use Dispatchable, SerializesModels, InteractsWithSockets;
    /**
     * A comment that was liked.
     *
     * @var \App\reply
     */
    public $reply;

    public $like;

    /**
     * Create a new event instance.
     *
     * @param \App\like $likes
     * @return void
     */
    public function __construct($like, $reply)
    {
        $this->like = $like;
        $this->reply = $reply;
    }
}
