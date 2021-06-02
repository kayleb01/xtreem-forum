<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\like;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Events\UserLikes;
use App\thread;


class likesController extends Controller
{


public function __construct()
{
	$this->middleware('auth');
}
public function index()
{

	return "We live baby!";
}

/**
*like and unlike the post
*
*
*
**/
 public function togglelikes($id)
 {
 	$replyId = intval($id);
 	$Reply = Reply::find($replyId);
 	$user_id = $Reply->likess()->where('user_id', '=', auth()->id())
 								->where('likable_id','=', $replyId)->first();
 	if (!$Reply->Isliked() ) {
 		$ike = $Reply->likeIt();
 		$likes = $Reply->Commentliked($replyId)->count();
 		// event(new UserLikes($ike));
 		return response()->json(['status' =>'success', 'message' => 'like', 'likes'=> $likes]);
 	} else {
 		$Reply->unlikeIt($replyId);
 		$likes = $Reply->Commentliked($replyId)->count();
 		if($likes == 0){
 			$likes ="";
 		}
 		return response()->json(['status'=>'success', 'message'=>'Unlike', 'likes'=> $likes]);

 	}
 }




}
