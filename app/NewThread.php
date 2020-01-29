<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class NewThread{
/**
     * Fetch all  threads.
     *
     * @return array
     */
    public function get()
    {
        return Cache::get($this->cacheKey(), collect())
                    ->sortByDesc('time')
                    ->slice(0, 5)
                    ->values();
    }

    /**
     * Push a new thread to the trending list.
     *
     * @param Thread $thread
     */
    public function push($thread, $increment = 1)
    {
        $newThread = Cache::get($this->cacheKey(), collect());

        $newThread[$thread->id] = (object) [
            'score'     => $this->score($thread),
            'title'     => $thread->title,
            'path'      => '/'.$thread->slug,
            'creator'   => $thread->user->username,
            'forum'     => $thread->forum->name,
            'time'      => $thread->created_at,
        ];
        $expiresAt = now()->addHours(24*5);
        Cache::put($this->cacheKey(), $newThread, $expiresAt);
    }

    /**
     * Get the trending score of the given thread.
     *
     * @param int
     */
    public function score($thread)
    {
        $newThread = Cache::get($this->cacheKey(), collect());

        if (! isset($newThread[$thread->id])) {
            return 0;
        }

        return $newThread[$thread->id]->score;
    }

    /**
     * Reset all trending threads.
     */
    public function reset()
    {
        return Cache::forget($this->cacheKey());
    }

    /**
     * Get the cache key name.
     *
     * @return string
     */
    private function cacheKey()
    {
        return 'new_threads';
    }



}
