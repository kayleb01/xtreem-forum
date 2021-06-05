<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyChild extends Model
{
    protected $table = 'comment_child';

    protected $fillable = ['user_id', 'reply_id', 'body'];


    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Reply::class);

    }

     /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/',
            '<a href="/u/$1">$0</a>',
            $body
        );
           }
}
