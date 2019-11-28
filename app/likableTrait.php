<?php


namespace App;
use Auth;
use App\like;

trait likableTrait{

 public function likeIt()	
 {
 	$like = new like();
 	$like->user_id = auth()->user()->id;
 	$this->likess()->save($like);
 	return $like;
 }
  public function unlikeIt($commentID)	
 {
 	$like = like::where('user_id', auth()->id())->where('likable_id', $commentID)->delete();
 }
public function likess()
{
	return $this->morphMany(like::class, 'likable');
}
 
public function Isliked()
{
	return (bool)$this->likess()->where('user_id', auth()->id())->first();
}

public function Commentliked($id)
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