<?php 

namespace App\Listeners;

use App\User;
use App\Event\ThreadRecievedNewReply;
use App\Notifications\youWereMensioned;

 /**
     * Handle the event.
     *
     * @param  mixed $event
     * @return void
     **/
class NotifyMensions
{
	
public function handle($event)
	{
		tap($event->subject(), function ($subject) {
            User::whereIn('username', $this->mentionedUsers($subject))
                ->get()->each->notify(new youWereMensioned($subject));
        });
	}

  /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers($body)
    {
        preg_match_all('/@([\w\-]+)/', $body, $matches);

        return $matches[1];
    }

}