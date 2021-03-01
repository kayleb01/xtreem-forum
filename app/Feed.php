<?php

namespace App;
use App\User;
use App\Forum;
use App\Categories;
use App\thread;
use App\comment;
use Auth;
use subscription;
use App\like;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
   protected $fillable = ['user_id', 'forum_id'];


   public function userFeed(){
   

   }
}
