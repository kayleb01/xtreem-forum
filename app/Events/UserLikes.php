<?php

namespace App\Events;

use App\like;
use Illuminate\Queue\SerializesModels;

class UserLikes
{
    use SerializesModels;

    /**
     * The thread that was published.
     *
     * @var \App\comment
     */
    public $like;

    /**
     * Create a new event instance.
     *
     * @param \App\Thread $comment
     * @return void
     */
    public function __construct(like $id)
    {
        $this->like = $id;
    }

    /**
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->like;
    }
}
