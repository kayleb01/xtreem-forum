<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use App\NewThread;
use App\Trending;


class ProfilesController extends Controller
{


    /**
     * Fetch the user's activity feed.
     *
     * @param User $user
     */
    public function index($user)
    { 
        $user = User::where('username', '=', $user)->first();
    
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
    public function show($username)
    {
     
     $user = User::where('username', '=', $username)->first();
        $data = ['profileUser' => $user];

        if (request()->expectsJson()) {
            return $data;
        }
      // $data. = 'title'=> 'Xtreemforum - Personal space';

        return view('profiles.show', $data);
    }

    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    // public function show($username, NewThread $newThread, Trending $trending)
    // {
    //     $user = User::where('username', '=', $username)->first();
        
    //     return view('profiles.show', [
    //         'title'         => 'Xtreemforum - Personal space',
    //         'newThread'     => $newThread,
    //         'trending'      => $trending,
    //         'profileUser'   => $user,
    //         'activities'    => Activity::feed($user)
    //     ]);
    // }
}
