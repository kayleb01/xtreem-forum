<?php

namespace App\Http\Controllers;
use Auth;
use Image;
use App\User;
use App\Follow;
use App\thread;
use App\comment;
use App\Activity;
use App\Trending;
use App\NewThread;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
	protected $fillable =['username', 'email', 'location', 'dob', 'sex', 'avatar', 'website'];

   /**
     * Fetch the user's activity feed.
     *
     * @#param User $user
     */
    public function index($user)
    {
        return [
            'activities' => Activity::feed($user)
        ];
    }

    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show1(User $user)
    {

         $data = ['profileUser' => $user];

        if (request()->expectsJson()) {
            return $data;
        }

        return view('profiles.show', $data);
    }

   public function show(NewThread $new_Thread, Trending $trending, $user){

   	$data = User::where('username', $user)->withCount([

           'follower as following' => function($q){
               return $q->where('follower_id', auth()->id());}

           ])->first();

      $threads   = thread::where('user_id', $data->id)->orderBy('created_at', 'DESC')->paginate(20);
      $comments  = comment::where('user_id', $data->id)->with('thread')->orderBy('created_at', 'DESC')->paginate(20);
      $newThread = $new_Thread->get();
      $trending  = $trending->get();
      $title     = 'XtreemForum - '.$data->username.'\'s Profile';

     return view('frontend.profile', compact('data', 'newThread', 'title', 'trending', 'threads', 'comments'));


   }

   public function edit($user){
      $user = User::where('username', $user)->first();
      $title = "Update User Profile";
   	return view('frontend.editProfile', compact('user', 'title'));
   }

   public function img($file){
            if($file){
         //Get the  filename with extension
         //Get just the filename
         //Just the extension
         $fulnameWithExt = $file->getClientOriginalName();
         $filenam =  pathinfo($fulnameWithExt, PATHINFO_FILENAME);
         $ext  = $file->getClientOriginalExtension();
         $filename  =  '$qwcsdiuhj'.time().'.'.$ext;
         $path = $request->pic->storeAs("public/storage/img", $filename);

         $upload = User::where('id', $request->id)->update(['image_url' => $filename]);
         if($upload){
            return back();
         }
      }else{
       return back()->with('error', 'Upload failed, please try again');
      }



   }

   public function update(Request $request, User $username){
        //The $username is an object that contains all the user details
        //So $username->id returns the userId
   	$user = User::where('id', $username->id)->update([
   		'location'	=> $request->location,
   		'website'	=> $request->web,
   		'bio'		=> $request->bio,
   		'dob'		=> $request->birthday
   	]);
   	if($user){

   		return Redirect('u/'.$username->username.'');
   	}else{
   		return back()->withInput();
   		}
   	}


    /**
     * Fetch all threads created by a user.
     *
     * @param Thread       $thread
     * @param User $user
     * @return mixed
     */
    public function user_threads($user, NewThread $NewThread, trending $trending){
        $users      = User::where('username', $user)->first();
        $threads    = thread::where('user_id', $users->id)->paginate(20);
        $title      =  'Xtreem Forum - '.$users->username.'\'s Threads';
        $newThread = $NewThread->get();
        $trending = $trending->get();
        return view('threads/user_threads', compact('threads', 'users', 'title', 'newThread', 'trending'));
    }





}
