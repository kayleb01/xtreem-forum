<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ThreadRecievedNewReply::class => [
            \App\Listeners\NotifyMensions::class,
            \App\Listeners\notifySubscriber::class
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        \App\Events\ThreadWasPublished::class => [
            \App\Listeners\NotifyMensions::class
        ],
        \App\Events\UserLikes::class => [
            \App\Listeners\LikesListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
