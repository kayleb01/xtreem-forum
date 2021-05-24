<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        $feed = DB::table('threads')->where(function($query) {

            $query->where('user_id', auth()->id())
                    ->orWhere('user_id', auth()->user()->following->pluck('id'));

        })->with([
            'likes',
            'likes as like' => function($q){
                $q->where('user_id', auth()->id())
                    ->orWhere('user_id',  auth()->user()->following->pluck('id'));
            }
        ])
        ->withCasts(['likes'=> 'boolean'])
        ->join('replies', 'threads.id', '=', 'thread_id')
        ->with('user')
        ->get();

        $reply = Reply::with(['thread', 'user'])->where('user_id', auth()->user()->following->pluck('id'));

        $merger = array_merge($feed, $reply);

        if ($request->wantsJson($merger)) {
          return response()->json($merger);
        }
    }
}
