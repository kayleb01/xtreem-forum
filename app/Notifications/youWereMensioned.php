<?php

namespace App\Notifications;

use App\comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class youWereMensioned extends Notification
{
    use Queueable;

    /**
     * @var \App\Reply or \App\Thread
     */
    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @param $subject
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
       return [
            'message' => $this->comment->user->username . ' mentioned you in ' . substr($this->comment->thread->title, 0,50),
            'link' => $this->comment->path()
        ];
    }

}
