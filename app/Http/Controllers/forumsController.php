<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Categories;
use Illuminate\Http\Request;
use App\NewThread;

class forumsController extends Controller
{
	/**
	*Retrieve and display all forums
	*@param Forum $forum
	*@param Categories $categories
	*/
 
	public function forum(NewThread $NewThread)
	{
		$forum = Forum::with('category')->get();
		$title = 'Xtreem Forum - Forums';
		$newThread = $NewThread->get();
		return view('threads/forums', compact('forum', 'title', 'newThread'));

	}













}
