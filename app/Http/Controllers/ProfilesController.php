<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;


class ProfilesController extends Controller
{



    /**
     * Fetch the user's activity feed.
     *
     * @param User $user
     */
    public function index($username)
    { 
        $user = User::where('username', '=', $username)->first();
         
        return [
            'activities' => Activity::feed($user)
        ];
    }

    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show1(User $user)
    {
     
        $data = ['profileUser' => $user];

        if (request()->expectsJson()) {
            return $data;
        }

        return view('profiles.show', $data);
    }

    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show( $username)
    {
        $user = User::where('username', '=', $username)->first();
        
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }
}
