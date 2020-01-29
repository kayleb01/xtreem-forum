<?php

namespace App;

use App\like;
use App\comment;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
 protected $appends = ['likedModel'];

    /**
     * Fetch the associated subject for the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Fetch the model record for the subject of the favorite.
     */
    public function getLikedModelAttribute()
    {
        $likedModel = null;

        if ($this->subject_type === like::class) {
            $subject = $this->subject()->get();
           // return dd($subject);
            if ($subject->likable_type == comment::class) {
                $likedModel = comment::find($subject->likable_id);
            }
        }

        return $likedModel;
    }

    /**
     * Fetch an activity feed for the given user.
     *
     * @param  User $user
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public static function feed($user)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->paginate(30);
    }
}
