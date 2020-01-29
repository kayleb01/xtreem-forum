<?php

namespace App\Http\Controllers;

use App\Http\Request\createPostRequest;
use App\comment;
use App\thread;
use Auth;
use Carbon\carbon;
use App\Events\ThreadRecievedNewReply;
use Linkify;
use Illuminate\Http\Request;
use App\attachment;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('replies');
    }
    /**
     * Persist a new reply.
     *
     * @param  integer           $channelId
     * @param  Thread            $thread
     * @param  CreatePostRequest $form
     * @return \Illuminate\Database\Eloquent\Model
     */

    public function store($slug, Request $request)
    {    
        $url = $request->body;
      
        $request->validate([
            'body' => 'required'
        ]);
        $thread = thread::where('slug', '=', $slug)->first();
        if ($thread->locked) {
            return response('Thread is locked', 422);
        }
        if (Auth::user()->is_banned) {
           return response('You are currently serving a ban, you cannot post a Comment', 422);
        }
         if (config('xf.security.limit_time_between_post')) {
            if ($this->time_btw_threads()) {
                return Redirect()->back()->with('error', 'Please wait for a minute before you post again')->withInput();
            }
        }   
        return $thread->AddComment([
            'user_id'       => Auth::user()->id,
            'thread_id'     => $thread->id,
            'forum_id'      => $thread->forum->id,
            'status'        => 1,
            'body'          => $url,
            'created_at'    => carbon::now()
            ])->load('user');
             
           $rep = $thread->replies_count;
            $thread->update([
                'last_reply_at' => carbon::now(),
                'reply_user'    => Auth::user()->id,
                'replies_count' => ++$rep
            ]);
            
            
    }

/**
     * Update the given thread.
     *
     * @param string $channel
     * @param Thread $thread
     */
    public function edir(Request $request, comment $id)
    {
        $slug = $id->thread->slug;
        $this->authorize('update', $id);
        $body = $request->body;        
        $id->update([
            'body' => $body
        ]); 

        return true;
    }


    /**
     * Update an existing reply.
     *
     * @param Reply $reply
     */
    public function update(comment $id)
    {
       $comment = $id;
        ///$this->authorize('update', $comment);
         $comment->update(request()->validate(['body' => 'required']));
        
    }

    /**
     * Delete the given reply.  
     *
     * @param  Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(comment $id)
    {
        $comment =  $id;
        //$this->authorize('update', $comment);
        $comment->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }

    //HandLes the Likes and UnLikes

    public function actOnLikes(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'like':
                Comment::where('id', $id)->increment('likes');
                break;
            
            case 'unlike':
                Comment::where('id', $id)->decrement('likes');
                break;
        }
        return "";
    }

    // public function image_save(Request $request)
    // {
    //     $image = $request->file;
    //     $path =
    //     if()
    //    foreach ($file as $files) {
    //        dd($files);
    //    }
    // }
    /**
    *Check spam by create a time limit between posts by a user;
    *
    */
    public function time_btw_threads(){
        $user = Auth::user();
        $time_diff = Carbon::now()->subMinutes(config('xf.spam_check.time_between_posts'));
        $recent_post = thread::where('user_id', '=', $user->id)->where('created_at', '>=', $time_diff)->first();
        if(isset($recent_post)){
            return true;
        }else{
            return false;
        }
    }
}
