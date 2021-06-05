<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Reply;
use App\ReplyChild;
use Illuminate\Http\Request;
use App\Events\ThreadRecievedNewReply;

class ReplyChildController extends Controller
{
    // @* @param int var comment $comment_id
    // Get the comment and store the reply to the parent comment

   public function store(Request $request, Reply $id)
   {
    $reply = ReplyChild::create([
        'user_id'       => Auth::user()->id,
        'reply_id'       => $id->id,
        'body'          => $request->replyChild
    ])->load('user');
    //event(new ThreadRecievedNewReply($reply));
      return $reply;
   }
   public function index($id)
   {
     return  ReplyChild::where('reply_id', $id)->with('user', 'comment')->paginate(5);
   }


   /*
   * *Delete the reply child if the user
   * *Has permission to do so
   * *
   * */
   public function destroy(ReplyChild $id)
   {
     if($id->user_id !== Auth::user()->id && Auth::user()->role !== 1 && Auth::user()->role !== 2){
       return response()->jsone(['error' => "Ooops! You cannot delete a reply that you didn't post"], 500);
     }else{

      $id->delete();
      if (request()->expectsJson()) {
        return response()->json(['status' => 'Reply deleted'], 200);
    }
      return back();
     }

   }
}
