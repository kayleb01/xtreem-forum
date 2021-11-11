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
            if ($id == auth()->id()) {
                return response()->json(['error', 'You cannot follow yourself'], 402);
            }
            $user = User::where('username', $user)->first();
            $user->following()->attach($id);
            return response()->json(['message' => 'You are now following']);

        }




         /**
     * @param User $user
     * @return mixed
     */

        public function destroy($user, $id)
        {
            $user = User::where('username', $user)->first();
            $user->following()->detach($id);
            return response()->json(['message' => 'Unfollowed']);
        }
}
