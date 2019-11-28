<?php 

namespace App\Listeners;

use App\User;
use App\Event\ThreadRecievedNewReply;
use App\Notifications\youWereMensioned;

/**
 * 
 */
class NotifyMensions
{
	
public function handle($event)
	{
		 User::whereIn('username', $event->comment->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new youWereMensioned($event->comment));
            });
	}

}