<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\like;
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
*@return Response $response
**/
 public function togglelikes($id)
 {
 	$replyId = intval($id);
 	$Reply = Reply::find($replyId);
 	$user_id = $Reply->likess()->where('user_id', '=', auth()->id())
 								->where('likable_id','=', $replyId)->first();
 	if (!$Reply->Isliked() ) {
 		$ike = $Reply->likeIt();
 		$likes = $Reply->ContentLiked($replyId)->count();
 		// event(new UserLikes($ike));
 		return response()->json(['status' =>'success', 'message' => 'like', 'likes'=> $likes]);
 	} else {
 		$Reply->unlikeIt($replyId);
 		$likes = $Reply->ContentLiked($replyId)->count();
 		if($likes == 0){
 			$likes ="";
 		}
 		return response()->json(['status'=>'success', 'message'=>'Unlike', 'likes'=> $likes]);

 	}
 }

 /**
*like and unlike the post
*@return Response $response
**/
public function threadLikes($id)
{
    $threadId = intval($id);
    $thread = thread::find($threadId);
    $user_id = $thread->likess()->where('user_id', '=', auth()->id())
                                ->where('likable_id','=', $threadId)->first();
    if (!$thread->Isliked() ) {
        $ike = $thread->likeIt();
        $likes = $thread->ContentLiked($threadId)->count();
        // event(new UserLikes($ike));
        return response()->json(['status' =>'success', 'message' => 'like', 'likes'=> $likes]);
    } else {
        $thread->unlikeIt($threadId);
        $likes = $thread->ContentLiked($threadId)->count();
        if($likes == 0){
            $likes ="";
        }
        return response()->json(['status'=>'success', 'message'=>'Unlike', 'likes'=> $likes]);

    }
}




}
