<?php

namespace App\Events;

use App\like;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class UserLikes
{
   use Dispatchable, SerializesModels, InteractsWithSockets;
    /**
     * A comment that was liked.
     *
     * @var \App\comment
     */
    public $like;

    /**
     * Create a new event instance.
     *
     * @param \App\like $likes
     * @return void
     */
    public function __construct($like)
    {
        $this->like = $like;
    }

    /**
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->like;
    }
}
