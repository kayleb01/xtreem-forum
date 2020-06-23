<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyChild extends Model
{
    protected $table = 'comment_child';

    protected $fillable = ['user_id', 'comment_id', 'body'];


    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(comment::class);

    }
   
}