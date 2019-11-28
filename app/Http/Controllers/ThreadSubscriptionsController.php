<?php

namespace App\Http\Controllers;

use App\thread;

class ThreadSubscriptionsController extends Controller
{
    /**
     * Store a new thread subscription.
     *
     * @param int    $channelId
     * @param Thread $thread
     */
    public function store(thread $thread)
    {
    // $threads = thread::where('slug', '=', $slug)->get();
        $thread->subscribe();
         

    }

    /**
     * Delete an existing thread subscription.
     *
     * @param int    $channelId
     * @param Thread $thread
     */
    public function destroy($forum, thread $thread)
    {
        $thread->unsub();
        return Redirect()->back()->with('success', 'Thread Unsubscribed');

    }
}
