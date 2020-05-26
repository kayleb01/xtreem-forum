<?php

namespace App;

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
  protected $appends = ['likableModel'];

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
    public function getLikableModelAttribute()
    {
        $likableModel = null;
     //dd($this->subject()->get());
        if ($this->subject_type === like::class) {
            $subject = $this->subject()->get();
            foreach ($subject as $subjects ) {
                if ($subjects->likable_type == comment::class) {
                    $likableModel = comment::find($subjects->likable_id);
                }
            }
            
        }

        return $likableModel;
    }

    /*
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
