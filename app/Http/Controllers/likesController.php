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

	return "!!!!";
}

/**
*like and unlike the post
*@return Response $response
**/
 public function togglelikes($id)
 {
 	$replyId = intval($id);
 	$reply = Reply::with('user','thread')->find($replyId);
 	$reply->likess()->where('user_id', '=', auth()->id())
 					->where('likable_id','=', $replyId)->first();
 	if (!$reply->Isliked() ) {
 		$ike = $reply->likeIt();
 		$likes = $reply->ContentLiked($replyId)->count();
 		event(new UserLikes($ike, $reply));
 		return response()->json(['status' =>'success', 'message' => 'like', 'likes'=> $likes, 'like' => $ike]);
 	} else {
 		$reply->unlikeIt($replyId);
 		$likes = $reply->ContentLiked($replyId)->count();
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
