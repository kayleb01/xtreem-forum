<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pages;


class pagesController extends Controller
{
   
public function index(){
	#.....show the pages from database
	$page = pages::all();
	return view('admin/pages', ['page' => $page]);
}

public function show(){
	#.......Shows the addPages 
	return view('admin/addPages');
}

public function edit(Pages $id){
	$page = pages::find($id->id);
	//dd($page->name);	
	return view('admin/edit_page', ['page' => $page]);
}

public function update(Request $request, $id){
$reqst = $request->all();
$upda  = Pages::where('id', $id)->update([
	'name' 		=> $reqst['name'],
	'content'	=> $reqst['content'],
	'slug'		=> str_slug($reqst['name'], '-')
]);
if($upda){
	return Redirect('admin/pages')->with('success', ''.$reqst['name'].' Updated successfully...');
}else{return back()->withInput();}

}

public function store(Request $request){
	$req 			= $request->all();
	$page 			= new pages;
	$page->name 	= $req['name'];
	$page->content 	= $req['content'];
	$page->slug 	= str_slug($req['name'], '-');
	$page->save();
	return Redirect('admin/pages')->with('success', 'Page created');
}


}
