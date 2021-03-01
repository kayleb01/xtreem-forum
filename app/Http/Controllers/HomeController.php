<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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

        })->withCount([
            'likes',
            'likes as like' => function($q){
                $q->where('user_id', auth()->id())
                    ->orWhere('user_id',  auth()->user()->following->pluck('id'));
            }
        ])
        ->withCasts(['likes'=> 'boolean'])
        ->join('comments', 'threads.id', '=', 'thread_id')
        ->with('user')
        ->get();

        if ($request->wantsJson($feed)) {
          return response()->json($feed);
        }
    }
}
