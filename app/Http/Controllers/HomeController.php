<?php

namespace App\Http\Controllers;

use App\Reply;
use App\thread;
use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

      $thread = thread::where(function($query){
          $query->where('threads.user_id', auth()->id())
                ->orWhereIn('threads.user_id', auth()->user()->following->pluck('id'));

      })->with(['user'])->latest()
            ->paginate(100)->toArray();


        $reply = Reply::with('thread')->where(function($query){
            $query->where('replies.user_id', auth()->id())
                    ->orWhereIn('replies.user_id', auth()->user()->following->pluck('id'));
        })->paginate(100)->toArray();
        $comment = ["comment" => $reply];
        $feed = $thread;
            if ($request->wantsJson($feed)) {
              return response()->json($feed);
            }
    }

}

