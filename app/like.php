<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use RecordsActivity;
    

/**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
protected $guarded = [];


    /**
     * Fetch the model that was favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
public function likable()
{
	return $this->morphTo();
}

public function user()
{
	return $this->belongsTo(User::class);
}
public function comment(){

	return $this->belongsTo(comment::class);
}
public function thread(){

	return $this->belongsTo(thread::class);
}


 /**
     * Get the number of favorites for the comment.
     *
     * @return int
     */
    // public function getlikesCountAttribute()
    // {
    //     return $this->likes->count();
   // }


}
