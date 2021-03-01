<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
   protected $table = 'moderators';
    protected $fillable = ['user_id', 'forum_id', 'role_id'];
}
