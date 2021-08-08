<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class LikeClicked extends Notification implements ShouldQueue
{
    use Queueable;


    /**
    **@var App\reply
    **/

    protected $reply;

    /**
    **@var App\reply
    **/

    protected $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $user)
    {
        $this->reply = $reply;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->user->username . ' liked  your comment on ' . $this->reply->thread->title,
            'link' => $this->reply->path()
        ];
    }
}
