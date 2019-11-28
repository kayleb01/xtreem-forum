<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
class UserNotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch all unread notifications for the user.
     *
     * @return mixed
     */
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }

    /**
     * mark all unread notifications for the user.
     *
     * @return mixed
     */
    public function markasread()
    {
        auth()->user()->unreadNotifications->markAsRead();
       return redirect()->back();
    }

    /**
     * Mark a specific notification as read.
     *
     * @param \App\User $user
     * @param int       $notificationId
     */
    public function destroy(Request $request, $id)
    {   
        $mark = auth()->user()->notifications()->findOrFail($request->id)->markAsRead();
            if($mark){
                return response()->json(['message'=>'Notification marked as read']);
            }else{
                return response()->json(['message'=>'Error marking notification']);
            }
    }
}
