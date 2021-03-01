<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{

   //use softDeletes;
   protected $with = [];
   protected $fillable = [
   'name',
   'description',
   'category',
   'reply_count',
   'slug',
   'last_poster_id',
   'last_post_id'
   ];
   protected $table = 'forums';
   
  
   public function comment()
   {
   	return $this->hasMany(comment::class);
   }

   public function category(){

     return $this->belongsTo(Categories::class, 'categories_id');
   }

   public function thread(){
      return $this->hasMany(thread::class);
   }
}
