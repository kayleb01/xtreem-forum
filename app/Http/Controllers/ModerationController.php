<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\report;
use Carbon\carbon;
use Middleware;
// use App\ban;
use DB;

class ModerationController extends Controller
{
   // protected function validator(array $data){
   // 	return Validator::make($data, [
   // 		'user_id'=> 'required',
   // 		'length' =>' required',
   // 		'reason' => 'required|string'
   // 		]);
   // }
   public function __construct(){
      $this->middleware('auth');
   }

   public function index()
   {
      $mod = new ban;
      $ban = $mod->count();

      $report = report::all()->count();
      return view('Admin.dashboard', [
         'ban'    => $ban,
         'report' => $report
      ]);
   }

   public function ban(User $user){
    $carbon = Carbon::now();
   	$banned = User::find($user->id);
    
   	return view('Admin.edit', [
         'user'=> $banned, 'carbon' => $carbon
      ]);
   }

   public function store(Request $request){
   	#_____Take all the requested user data and save in the data base......
    
  $input = $request->all();
if(!empty($input['id'])){
   $user = User::find(($input['id'])); 
   /*.................
  Check to see if the user is an Admin or a Moderator....//
  */
  if($user->role == 1 || $user->role == 2){return back()->with('error', 'The Admin and moderator cannot be banned'); }
  $bans =  $user->bans()->create([
   'comment' => $request->input('reason'),
   'expired_at' => $request->input('length'),
]);
  //**************If Ban was successful redirect to list of banned members
  if($bans){return Redirect('moderation/banned')->with('success', 'User Ban was successful!');
}else{return back()->with('error', 'User is currently Serving a ban');}
}  
   

   }
   #Get all users that have been banned
   #and then pass them to the page to be rendered
   public function banned(){
   	
   	$user = User::onlyBanned()->paginate(15);
      
   	return view('Admin.Banned', ['user' => $user]);
   }
// Unban the user currently serving a ban
#***************If The ID is empty return an error
 //if the unban was successful, update the users table...
  public function revoke($id){   
      if(!empty($id)){
         $users = User::withBanned()->find($id);
           $users->unban();
            $del = User::withBanned()->where('id', '=', $id)->update(['banned_at' => NULL]);
         return back()->with('success', 'User Unbanned successfully Uplifted');
        }
      else{
         return back()->with('error', 'user does not exist, please contact the Admin for further directives');
      }

  }
   


public function users(){
#.........This just gets the users for the Moderation
	$users = User::withBanned()->paginate(15);
	return view('Admin.Modusers', ['user' => $users]);
}

public function search(Request $request)
{
   # code...
}

public function report(Request $request)
{
   $report = new report;
   $data = $report->all();
   return view('Admin.reports', ['report' => $data]);
}
 
 public function User_edit(user $user){
return view('Admin.mod_edit', compact('user'));
 }

public function update(Request $request){
$this->validate($request, [ 
   'username'  => 'required|min:3',
   'email'     => 'required|email',
   'location'  => 'nullable',
   'sex'       => 'required',
   'bio'       => 'nullable',
   'website'   => 'nullable',
   'dob'       => 'required'
]);

if(!empty($request)){
$q = User::where('id', $request->_user)->update([
'username'  => $request->username,
'email'     => $request->email,
'location'  => $request->location,
'sex'       => $request->sex,
'bio'       => $request->bio,
'website'   => $request->website,
'dob'       => $request->dob
]);
//dd($q);
      if($q){
         return Redirect('/moderation')->with('success', 'User '. $request->username . ' Modified!');
      }
   }
   else{
   return Redirect()->back();
   }
}

public function destroy(Request $request){
   //$user =  User::find)->first();
  User::destroy($request->_user);
   return Redirect('moderation/users')->with('success', 'User Deleted!');;
}



}

