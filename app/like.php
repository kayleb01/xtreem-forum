<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use RecordsActivity;
    
const Table = 'likes';
  
protected $guarded = [];
// protected static function bootLikable()
//     {
//         static::deleting(function ($model) {
//             $model->likes->each->delete();
//         });
//     }

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
    public function getlikesCountAttribute()
    {
        return $this->likes->count();
    }


}
