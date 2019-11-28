<?php

namespace App\Http\Controllers;
use App\User;
use App\thread;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\carbon;
use App\NewThread;
use App\Trending;
use Image;
use Activity;

class ProfileController extends Controller
{
	protected $fillable =['email', 'location', 'dob', 'sex', 'image_url', 'website'];

   /**
     * Fetch the user's activity feed.
     *
     * @#param User $user
     */
    public function index(User $user)
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
   	//$role = User::find(1)->role;
   	$data = user::where('username', $user)->get();
    foreach ($data as $user_data) {
      $threads    = thread::where('user_id', $user_data->id)->paginate(20);
      $newThread = $new_Thread->get();
      $trending  = $trending->get();
      $title     = 'XtreemForum - '.$user_data->username.'\'s Profile';
     return view('frontend.profile', compact('user_data', 'newThread', 'title', 'trending', 'threads'));
    }
   
   }

   public function edit($user){
      $user = User::where('username', $user)->first();
   	return view('frontend.editProfile', compact('user'));
   }

   public function img(Request $request){
            if($request->hasFile('pic')){
         //Get the  filename with extension
         //Get just the filename
         //Just the extension
         $fulnameWithExt = $request->pic->getClientOriginalName();
         $filenam =  pathinfo($fulnameWithExt, PATHINFO_FILENAME);
         $ext  = $request->pic->getClientOriginalExtension();
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

   public function update(Request $request, User $user){
   	$this->validate($request, [ 
   	   		'email'		=>'required',
   	   		 'location'	=>'required|min:2',
   	   		 'dob'		=>'required',
   	   		 'sex'		=>'required',
   	   		 'bio'		=> 'nullable',
   	   		 'website'	=>'nullable']);


   	$user = User::where('id', $request->_user)->update(
   		['email' 	=> $request->email,
   		'location'	=> $request->location,
   		'sex'		=> $request->sex,
   		'website'	=> $request->website,
   		'bio'		=> $request->bio,
   		'dob'		=> $request->dob
   	]);
   	if($user)
   	{
   		return Redirect('user/'.$request->username.'');
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
    public function user_threads($user, NewThread $NewThread){
        $users      = User::where('username', $user)->first();
        $threads    = thread::where('user_id', $users->id)->paginate(20);
        $title      =  'Xtreem Forum - '.$users->username.'\'s Threads';
        $newThread = $NewThread->get();
        return view('threads/user_threads', compact('threads', 'users', 'title', 'newThread'));
    }





}
