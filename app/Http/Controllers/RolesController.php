<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{

public function role(){
  return view('Admin.role');
}

public function create(Request $request){
//create the user role

  	$request->all();
	$role = Role::create([
    'role'  => $request['role'],
    'permissions' => $request['permission']
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
