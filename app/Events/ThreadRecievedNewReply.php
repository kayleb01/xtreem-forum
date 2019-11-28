<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class ThreadRecievedNewReply 
{
   use Dispatchable, SerializesModels, InteractsWithSockets;

    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /*
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->comment;
    }
    /*
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     
    public function broadcastOn()
    {
        return new PrivateChannel('xtreem-notify');
    }*/
}
