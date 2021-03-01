<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
   protected $table = "follows";
   protected $fillable = ['followed_id', 'follower_id'];

   /*
   *Relationships
   */
  public function following()
  {
     return $this->belongsTo(User::class);
  }


}
