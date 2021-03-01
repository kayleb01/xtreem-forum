<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Moderator;
use App\Forum;

class RolesController extends Controller
{

public function role(){
$users = User::get();
$forums	= Forum::get();
  return view('Admin.role', compact('users', 'forums'));
}


//create the user role
public function storeRole(Request $request){
	// return $request;
	  $request->validate([
		  'user' =>'required',
		  'role' => 'required'
	  ]);
	  $check = Moderator::where('user_id', $request->user)->first();
	  if($check){
		return Redirect('admin/roles')->with('error', 'user role exists');
	  }
	$role = Moderator::create([
    'user_id'  => $request->user,
	'forum_id' => $request->forum,
	'role_id'	=> $request->role
  		 ]);
	if($role){
		return Redirect('admin/roles')->with('success', 'user role created');
	}else{
		return Back()->with('error', 'An error was encountered');
	}
}

public function roles(){
  $role = Role::all();
  return view('admin/roles', compact('role'));
}

public function edit(Role $id){
//dd($id);
return view('Admin/role_edit', ['role' => $id]);
}

public function store(Request $request, $id){
	$this->validate($request,[
		'role' => 'required',
		'permission' => 'required'
	]);
	 $req = $request->all();
	 $role = Role::where('id', $id)->update([
		'role' 			=> $req['role'],
	 	'permissions' 	=> $req['permission']
	 ]);	 
	if($role){return Redirect('admin/roles')->with('success', 'User role updated');}else{
		return back()->withInput();
	}
	
}




}
