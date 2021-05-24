<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Reply;


class likesController extends Controller
{


public function __construct()
{
	$this->middleware('auth');
}

/**
*like and unlike the post
*
*
*
**/
 public function togglelikes($id)
 {
 	$commentID = intval($id);
 	$comment = Reply::find($commentID);
 	$user_id = $comment->likess()->where('user_id', '=', auth()->id())
 								->where('likable_id','=', $commentID)->first();
 	// if(!$user_id){
 	// 	$thread = thread::find($commentID);
 	// 	$user_id =$thread->likess()->where('user_id', '=', auth()->id())
 	// 								->where('likable_id', '=', $commentID)->first();
 	// }
 	if (!$comment->Isliked() ) {
 		$ike = $comment->likeIt();
 		$likes = $comment->Commentliked($commentID)->count();
 		// event(new UserLikes($ike));
 		return response()->json(['status' =>'success', 'message'=>'like', 'likes'=> $likes]);
 	} else {
 		$comment->unlikeIt($commentID);
 		$likes = $comment->Commentliked($commentID)->count();
 		// $comment->decrement('likes');
 		if($likes == 0){
 			$likes ="";
 		}
 		return response()->json(['status'=>'success', 'message'=>'Unlike', 'likes'=> $likes]);

 	}
 }




}
