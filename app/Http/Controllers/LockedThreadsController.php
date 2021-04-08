<?php

namespace App\Http\Controllers;

use App\thread;

class LockedThreadsController extends Controller
{
    /**
     * Lock the given thread.
     *
     * @param \App\Thread $thread
     */
    public function store(thread $id)
    {
        $id->update(['locked' => true]);
        return Redirect()->back()->with('success', 'Thread locked');
    }

    /**
     * Unlock the given thread.
     *
     * @param \App\Thread $thread
     */
    public function destroy(thread $id)
    {
        $id->update(['locked' => false]);
        return Redirect()->back()->with('success', 'Thread Unlocked');
    }
}
