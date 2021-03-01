<?php

namespace App\Http\Controllers;


use App\User;


class FollowersController extends Controller
{

            /**
     * r.
     *
     * @param User $user
     *
     *
     * @return mixed
     */
        public function store($user, $id)
        {
            $user = User::where('username', $user)->first();
            $user->following()->attach($id);
            return redirect()->back();

            }




         /**
     * r.
     *
     * @param User $user
     *
     *
     * @return mixed
     */

        public function destroy($user, $id)
        {
            $user = User::where('username', $user)->first();
            $user->following()->detach($id);
            return redirect()->back();
        }
}
