<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class threadUpdated extends Notification
{
    use Queueable;


    /**
    **@var App\thread
    **/
    protected $thread;

    /**
    **@var App\reply
    **/
    protected $comment;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread, $comment)
    {
        $this->thread = $thread;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            'message' => $this->comment->user->username . ' replied to ' . $this->thread->title,
            'link' => $this->comment->path()
        ];
    }
    public function toMail($notifiable)
{
    $url = url($this->comment->path());

    return (new MailMessage)
                ->greeting('Hello!  '. $this->comment->user->username .'')
                ->line($this->comment->user->username . ' replied to ' . $this->thread->title)
                ->action('View reply', $url)
                ->line('XtreemForum.com Team');
}
}
