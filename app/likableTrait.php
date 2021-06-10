<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use App\like;

trait likableTrait{
    /**
     * Boot the trait.
     */
    protected static function bootLikableTrait()
    {
        static::deleting(function ($model) {
            $model->likess->each->delete();
        });
    }


 public function likeIt()
 {
 	$like = new like();
 	$like->user_id = auth()->user()->id;
 	$this->likess()->save($like);
 	return $like;
 }

public function unlikeIt($id)
 {
 	$like = like::where('user_id', auth()->id())->where('likable_id', $id)->delete();
 }

public function likess()
{
	return $this->morphMany(like::class, 'likable');
}

public function Isliked()
{
	return (bool)$this->likess()->where('user_id', auth()->id())->count();
}

public function ContentLiked($id)
{
	return $this->likess()->where('likable_id', $id)->get();
}


/**
     * Get the number of likes for the comment.
     *
     * @return int
     */
    public function getLikesCountAttribute()
    {
        return $this->likess->count();
    }


     /**
     * Fetch the liked status as a property.
     *
     * @return bool
     */
    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

}








































?>
