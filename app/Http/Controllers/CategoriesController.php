<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoriesController extends Controller
{

 public function index(){
  	$cat = Categories::all();
  	return view('Admin/category', ['cat'=>$cat]);
}

 public function show(){
 	return view('Admin/cat_create');
 }

public function edit(Categories $id){
	$cat = Categories::find($id->id);
    return view('Admin/edit_cat', ['categories'=> $cat]);
}

public function store(Request $request){

    $req 	=  $request->all();
    $catr 	= Categories::create([
    'name'	=> $req['name'],
    'description' => $req['description']
    ]);
    if ($catr) {
        # code...
        return Redirect('admin/categories')->with('success', 'New Category Created');
    }
    return back()->with('error', 'An internal error was encountered');
}

public function update(Request $request, $id){
	$this->validate($request, [
		'name' =>'required',
		'description' => 'required'
	]);
	$req = $request->all();
	$cat = Categories::where('id', $id)->update([
		'name' => $req['name'],
		'description' => $req['description']
	]);
    if($cat){
        return Redirect('admin/categories')->with('success', ''.$req['name'].' Updated successfully');
    }
        return back()->with('error', ''.$req['name'].' Updated failed');
    }

}
//End of the Class
