<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
   protected $table = "follows";
   protected $fillable = ['user_id', 'followers_id'];

   /*
   *Relationships
   */
  public function user()
  {
     return $this->hasMany(User::class);
  }

  
}
