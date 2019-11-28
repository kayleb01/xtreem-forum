<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use RecordsActivity;
    
protected $table = 'likes';
  
protected $guarded = [];

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

 public function getlLikedModelAttribute()
    {
        $favoritedModel = null;

        if ($this->subject_type === like::class) {
            $subject = $this->subject()->firstOrFail();

            if ($subject->favorited_type == Reply::class) {
                $favoritedModel = comment::find($subject->favorited_id);
            }
        }

        return $favoritedModel;
    }
}
