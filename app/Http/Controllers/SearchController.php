<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use App\Trending;
use App\thread;
use App\NewThread;

class SearchController extends Controller
{
    /**
     * Show the search results.
     *
     * @param  \App\Trending $trending
     * @return mixed
     */
    public function show(Request $request, Trending $trend, NewThread $NewThread)
    {
    $threads = comment::with('thread')->where('body', 'like','%'.$request->q.'%')->get();
    $trending = $trend->get();
    $newThread =$NewThread->get();
    $title = "search results";
    // dd($threads);
    return view('threads.search', compact('threads','trending','title', 'newThread'));
    }
}
