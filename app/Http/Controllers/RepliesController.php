<?php

namespace App\Http\Controllers;

use App\Http\Request\createPostRequest;
use App\Reply;
use App\thread;
use Auth;
use Carbon\carbon;
use Illuminate\Validation\Rule;
use App\Events\ThreadRecievedNewReply;
use Illuminate\Http\Request;
use App\Media;



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
    //    dd($request);
        $request->validate([
            'body' => 'required',
            'imageIds.*' => [
                Rule::exists('media', 'id')
                ->where(function ($query) use ($request){
                    $query->where('user_id', $request->user()->id);
                })
            ]
        ]);
        $thread = thread::where('slug', '=', $slug)->first();
        if ($thread->locked) {
            return response('Thread is locked', 422);
        }
        if (Auth::user()->is_banned) {
           return response('You are currently serving a ban, you cannot post a comment', 422);
        }
         if (config('xf.security.limit_time_between_post')) {
            if ($this->time_btw_threads()) {
                return Redirect()->back()->with('error', 'Please wait for a minute before you post again')->withInput();
            }
        }


        $threadIn = $thread->AddComment([
            'user_id'       => Auth::user()->id,
            'thread_id'     => $thread->id,
            'forum_id'      => $thread->forum->id,
            'status'        => 1,
            'body'          => $url,
            'created_at'    => now()
            ])->load('user');

            //store media attachments
            Media::find($request->imageIds)->each->update([
                        'model_id' => $threadIn->id,
                        'model_type' => Reply::class
                    ]);

           $rep = $thread->replies_count;
            $thread->update([
                'last_reply_at' => Carbon::now(),
                'reply_user'    => auth()->id(),
                'replies_count' => ++$rep
            ]);
        return $threadIn;

    }

/**
     * Update the given thread.
     *
     * @param string $channel
     * @param Thread $thread
     */
    public function edir(Request $request, Reply $id)
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
    public function update(Reply $id)
    {
       $reply = $id;
        ///$this->authorize('update', $reply);
         $reply->update(request()->validate(['body' => 'required']));

    }

    /**
     * Delete the given reply.
     *
     * @param  Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reply $id)
    {   //for readability
        $reply =  $id;
        //$this->authorize('update', $reply);
        $reply->delete();

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
                Reply::where('id', $id)->increment('likes');
                break;

            case 'unlike':
                Reply::where('id', $id)->decrement('likes');
                break;
        }
        return "";
    }


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

    public function replies($slug){
        $thread = thread::where('slug', '=', $slug)->first();
        return Reply::where('thread_id', $thread->id)
                        ->with(['user','thread', 'media'])
                        ->paginate(10);
    }
}
