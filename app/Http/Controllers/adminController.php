<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\User;
use App\Forum;
use App\thread;
use App\Role;
use App\comment;
//use App\ban;
Use App\Categories;
use App\Role_User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Middleware;
use Auth; 
use DB;
use Carbon\carbon;

class adminController extends Controller
{
 
  public function __construct(){
    
    $this->middleware('auth');
  }

  public function dashboard(){
  	$user = new User;
  if(auth()->user()->role !== 1){
  	return redirect('home')->with('errors', 'Unauthorized access ');
  }
	#.......Get all the info from ban, posts, comments, users for the 
	#.......FOR THE DASHBOARD .....#
	$users = user::all()->count();
	$posts = count(thread::all());

	return view('Admin.layouts.index')->with(
		array('users' => $users,
			  'posts' => $posts,
			 
			));

  }

  public function Users(){
  	#****Get all users and paginate
	$user  = User::paginate(4);
  	return view('Admin.users')->with('user', $user);
  }

public function search(Request $request){
	
	$data = $request->search;
	$output = user::where('username', 'like', '%'. $data .'%')
					->paginate(20);
						//dd($output);
	return view('Admin.users')->with('user', $output);
	
 }
 public function edit(User $user){
 	return view('Admin.edit_user', compact('user'));
 }

 public function update(Request $request){
  $this->validate($request, [ 	
			'username'	  =>'required|min:5',
   	   	'email'		  =>'required',
   	   	'location'	=>'required|min:2',
   	   	'dob'		    =>'required',
   	   	'sex'		    =>'nullable',
   	   	'bio'		    => 'nullable',
   	   	'website'	  =>'nullable']);
   	$user = User::where('id', $request->_user)->update([
      'username'    => $request->username,
   		'email' 	    => $request->email,
   		'location'	  => $request->location,
   		'sex'		      => $request->sex,
   		'website'	    => $request->website,
   		'bio'		      => $request->bio,
   		'dob'		      => $request->dob
   	]);
   	if($user)
   	{
   		return Redirect('user/'.$request->username.'');
   	}else{
   		return back()->withInput();
   		}
 }
 

public function destroy(user $id){// Deleting a user
  if($id->id === Auth::user()->id && Auth::user()->role === 1){return back()->with('error', 'Cannot delete your loggedIn Account nor the Admin');}
    $user = user::where('id', $id->id)->delete(); 
     if($user){
        return Redirect('admin/users')->with('success', 'User Deleted!');;
     }else{
        Redirect()->back()->with('errors', 'Delete failed, please contact the Administrator');
     }
     
}
public function store(Request $request){
      $user = new User;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->location = $request->location;
        $user->sex      = $request->sex;
        $user->bio      = $request->bio;
        $user->dob      = $request->dob;
        $user->password = bcrypt($request->pass);
        $q = $user->save();
      if($q){
       return redirect('admin/users')->with('success', 'User created successfully');
      }else{
        return back()->withInput();
    }
}

public function store_forum(Request $request){
  if(isset($request)){
    //Validate the request//
    $this->validate($request, [
      'name'        => 'required',
      'description' => 'required',
      'reply_count' => 'nullable',
      'last_posters_id' => 'nullable',
      'last_post_id'    => 'nullable',

    ]);
    //?? Input into the database..**
    $forum = new forum;
    $forum->name        = $request->name;
    $forum->description = $request->description;
    $forum->slug        = $request->name;
    $forum->categories_id = $request->category;
    if($forum->save()){
      return Redirect('admin/forums')->with('success', 'Forum created!');
    }
  }
}

public function new_forum(){
  //displays the page to create new forums
  $forum = categories::all();
  return view('admin/addForum', ['forum' => $forum]);
}

public function view(){
  //Displays the forums
  
$forum = forum::paginate(15);
return view('admin/forums',['forum' => $forum]);
}

public function edit_forum(Forum $forum){
  $categories = Categories::all();
return view('admin/edit_forum', ['forum' => $forum, 'cat' => $categories]);
}

public function update_forum(Request $request, $id){
if(isset($request)){
  $this->validate($request,[
    'name' => 'required',
    'description' =>'required']);

  $req = $request->all();
  $query = Forum::where('id', $id)->update([
    'name' => $req['name'],
    'description' => $req['description'],
    'categories_id'    => $req['category']

  ]);
  return Redirect('admin/forums')->with('success', ''.$req['name'].' Updated successfully');
  }

}
 
 public function removed_threads(){
  $threads =  thread::onlyTrashed()->paginate(10);
    return view('admin/removed_thread', ['thread' => $threads]);
 }



public function deleted(){
  $users = User::onlyTrashed()->paginate(10);
  return view('admin/deleted', ['user' => $users]);
}

public function restore($id){
  $user = User::withTrashed()->find($id);
 if($user->restore()){
  return Redirect('admin/users/deleted')->with('success', ''.$user->username.' restored successfully');
 }
}

}//end of the class
    