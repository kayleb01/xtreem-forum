<?php

namespace App\Http\Controllers\Api;

use App\thread;
use App\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
     /**
     * Fetch data for the feed
     *fetch all threads by people you're following and also their comments
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // $feed = DB::table('threads')->where(function($query) {

        //     $query->where('threads.user_id', auth()->id())
        //             ->orWhere('threads.user_id', auth()->user()->following->pluck('id'));
        //           })
        //             ->join('comments', 'threads.id', '=', 'comments.thread_id')
        //             ->Where('comments.user_id', auth()->user()->following->pluck('id'))
        //             ->get();

        $feed = thread::where(function($query){
            $query->where('threads.user_id', auth()->id())
                    ->orWhereIn('threads.user_id', auth()->user()->following->pluck('id'));
        })->with([
            'user',
            'comment' => function($q){
                $q->where('user_id',  auth()->user()->following->pluck('id'));
            }

        ])->withCount([

            'like',
            'like as likes' => function($q){
                $q->where('user_id',  auth()->user()->following->pluck('id'));
            }

        ])->latest()
          ->paginate(100);
            $comments = comment::with(['thread', 'user'])->where('user_id', auth()->user()->following->pluck('id'))->latest()->get();


        if ($request->wantsJson($feed)) {
          return response()->json($feed);
        }
        return $feed;
    }
}
