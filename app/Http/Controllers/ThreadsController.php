<?php

namespace App\Http\Controllers;

use App\Categories;
use App\filter\ThreadFilters;
use App\thread;
use App\User;
use App\Trending;
use App\NewThread;
use App\comment;
use App\Forum;
use Carbon\carbon;
use Rules\SpamFree;
use Auth;
use Linkify;
use App\attachment;
use Illuminate\Http\Request;
use App\Events\ThreadReceivedNewReply;
use Illuminate\Support\Str;




class ThreadsController extends Controller
{
    /**
     * Create a new ThreadsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'forums', 'replies']);
    }

    /**
     * Display a listing of the front page.
     *
     * @param  Channel      $channel
     * @param ThreadFilters $filters
     * @param \App\Trending $trending
     * @return \Illuminate\Http\Response
     */
    public function index(Categories $category, Trending $trending, NewThread $NewThread)
    {   //get the front page threads
        //  $threads = $this->getThreads($category, $filters);

        // if (request()->wantsJson()) {
        //     return $threads;
        // }
        $getFeatured = thread::where('fp', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->simplePaginate(30);
        
                    $title          = 'XtreemForum';
                    $newThread      = $NewThread->get();
                    $trending       = $trending->get();     
                    $Categories     = Categories::all();
        //load the view
        return view('home', compact('getFeatured', 'trending', 'newThread', 'title','Categories'));

    }
   

    public function replies($slug){
        $thread = thread::where('slug', '=', $slug)->first();

        return comment::where('thread_id', $thread->id)
                        ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Forum $id, Trending $trending, NewThread $NewThread)
    {
        $forum        = $id;
        $newThread    = $NewThread->get();
        $trending     = $trending->get(); 
        $title = 'Xtreem Forum - Create Thread';
        return view('threads.create', compact('forum', 'title','trending', 'newThread'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request, NewThread $NewThread)
    {
        if(Auth::user()->confirmed != 1){
            Redirect()->back()->with('error', 'Your have not verified your account, you cannot post, please verify account email');
        }
        $request->validate([
            'title'         => 'required|max:150',
            'body'          => 'required|max:8000',
            'image'         => 'image|mimes:jpeg,jpg,gif,png|size:4096'
        ]);
        if (config('xf.security.limit_time_between_post')) {
            if ($this->time_btw_threads()) {
                return Redirect()->back()->with('error', 'Please wait for a minute before you post again')->withInput();
            }
        }
        // Lets try to always have a unique slug
        $slug = Str::slug(request('title'), '-');
        $same_slug = thread::where('slug', '=', $slug)->first();
        $incremnt = 1;
        $incremnted_slug = $slug;
        // lets loop through to make sure we don't have a slug thats not unique
        while(isset($same_slug->id)){
            $incremnted_slug = $slug.'-'.$incremnt;
            $same_slug = thread::where('slug', '=', $incremnted_slug)->first();
            $incremnt += 1;
        }
        if($slug != $incremnted_slug){
            $slug = $incremnted_slug;
        }

        $user_id = Auth::user()->id;
        $thread = thread::create([
            'user_id'       => $user_id,
            'cat_id'        => request('category_id'),
            'forum_id'      => request('forum_id'),
            'slug'          => $slug,  
            'title'         => request('title'),
            'body'         => request('body'),
            'reply_user'   => $user_id,
        ]);
        
        if (request()->wantsJson()) {
            return response($thread, 201);
        }
         if($request->hasFile('file')){
                            //Image upload
                         $images = $request->file('file');
                        foreach ($images as $key => $image) {
                $fulname        = $image->getClientOriginalName();
                $filenam        = pathinfo($fulname, PATHINFO_FILENAME);
                $ext            = $image->getClientOriginalExtension();
                $filename       = rand().time().'.'.$ext;
                $Img            = $image->storeAs("/storage/storage/img/", $filename);
                $upload         = attachment::create([
                                                        'user_id'   => Auth::user()->id,
                                                        'thread_id' => $thread->id,
                                                        'filename'  => $fulname,
                                                        'name'      => $filename
                                                        ]);
                                                   
            }  //end of foreach   
        }
        
        if( $thread ){
            $NewThread->push($thread);
            return redirect($thread->path());
        }else{
            return redirect()->back()->with('error', 'An error was encountered');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  integer      $channel
     * @param  \App\Thread  $thread
     * @param \App\Trending $trending
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Trending $trending, NewThread $NewThread)
    {     
        
        //get all comments for this thread
       $threads  = thread::where('slug', '=', $slug)->get();
        // if (auth()->check()) {
        //    auth()->user()->read($threads);
        //      } 
        
        foreach ($threads as $thread) {
       //   dd(json_encode($thread));
        $newThread = $NewThread->get();
        $thread->increment('visits');
        $trending->push($thread);
        $comment = comment::where('thread_id', '=', $thread->id)->paginate(20);
        $title = $thread->title;
        return view('threads.show')->with(['thread' => $thread, 'comment' => $comment, 'title' => $title, 'newThread' => $newThread]);
        }
        
    }

    // Fetch all the data of the thread
    // @param thread $thread
    public function edit(thread $id) {
      //For readability
      $thread = $id;
        return view('threads.edit')->with(['thread'=>$thread, 'title' => 'Edit thread']);

    }

    /**
    *Display all the forums content
    *
    *@param Forum $forums
    *;
    */
    public function forums($slug, NewThread $NewThread){
        if(empty($slug)){
            Redirect()->back();
        }
        else
        {
            $forum = Forum::where('slug', '=', $slug)->first();
            $forum_ID = $forum->id;
             $newThread = $NewThread->get();
            //Get all the posts from the forum
            $threads = Thread::with('category')->where('forum_id', $forum_ID)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
                        if(empty($threads[0])){
                            $threads = $forum_ID;
                            $title = 'Forums';

                            return view("threads.no_forum", compact('threads', 'title', 'newThread'));
                        }else{
                            
                            $title = $threads[0]->forum->name;
                            return view('threads.forum', compact('threads', 'title', 'newThread'));
                        }                   
        }
    }

    /**
     * Update the given thread.
     *
     * @param string $channel
     * @param Thread $thread
     */
    public function update(Request $request, thread $thread)
    {
       
        //$this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]));

        return redirect('/'.$thread->slug);
    }



    /**
     * Delete the given thread.
     *
     * @param $category
     * @param Thread $thread
     * @return mixed
     */
    public function destroy(thread $id)
    {
       if(Auth::user()->role == 1 || Auth::user()->role == 2 )
        {//$this->authorize('update', $thread);
        $thread = $id;
        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }
        return redirect('/forum/'.$thread->forum->name.'')->with('success', 'Thread deleted');
        }else{
            return redirect()->back()->with('error', 'Unable to delete');
        }
    }

    /**
    *Make a thread featured on the front page
    *@param Thread $thread
    *@param $id
    *@return mixed
    */
    public function make_fp($id)
    {
     if(Auth::user()->role == 1 || Auth::user()->role == 2){
        $thread = new thread;
        $thread->where('id', $id)->update(['fp'=> 1]);
        return Redirect()->back()->with('success', 'Marked as Featured Post');
     }else{
       return redirect()->back()->with('Error', 'An error occured, please contact the Administrator');
     }
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



    /**
     * Fetch all relevant threads.
     *
     * @param Channel       $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Categories $category, ThreadFilters $filters)
    {
        $threads = thread::latest('pinned')->latest()->with('category')->filter($filters);
        if ($category->exists) {
            $threads->where('cat_id', $category->id);
        }

        return $threads->paginate(25);
    }

}
