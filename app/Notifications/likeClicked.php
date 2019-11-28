<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\likeClicked;


class likeClicked extends Notification
{
    use Queueable;


    /**
    **@var App\comment
    **/
    protected $comment;

    /**
    **@var App\like
    **/
    protected $like;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $like)
    {
        $this->comment = $comment;
        $this->like = $like;
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
            'message' => $this->like->user->username . ' liked ' . $this->comment->thread->title,
            'link' => $this->comment->path()
        ];
    }
}
