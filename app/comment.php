<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\thread;
use Illuminate\Database\Eloquent\Collection;

class comment extends Model
{
    use likableTrait;
    use RecordsActivity;
    
    const TABLE = 'threads';
  /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user', 'thread'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['likesCount', 'isLiked',   'path'];

    /**
     * Boot the reply instance.
     */
    protected static function boot()
    {
         
        parent::boot();

        static::deleted(function ($comment) {
            $comment->thread->decrement('replies_count');
        });

      
    }


    public function forum(){
        return $this->belongsTo('App/Forum');
    }

    /**
     * A reply has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function like(){
        return $this->hasMany(like::class, 'likable_id');
    }

    /**
     * A reply belongs to a thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('App\thread', 'thread_id');
    }
    //Files uploaded in comments
    //
    public function attachment()
    {
        return $this->hasMany(attachment::class);
    }

    /**
     * Get the related title for the reply.
     */
    public function title()
    {
        return $this->thread->title;
    }

    /**
     * Determine if the reply was just published a moment ago.
     *
     * @return bool 
     */
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    /**
     * Determine the path to the reply.
     *
     * @return string
     */
    public function path()
    {
        $replyPosition = $this->thread->comment()->pluck('id')->search($this->id) + 1;

        $page = ceil($replyPosition / 25);

        return $this->thread->path()."?page={$page}#comment-{$this->id}";
    }

    /**
     * Fetch the path to the thread as a property.
     */
    public function getPathAttribute()
    {
       return $this->path();
    }

    /**
     * Access the body attribute.
     *
     * @param  string $body
     * @return string
     */
    public function getBodyAttribute($body)
    {
        return (nl2br($body));
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
            '<a href="/user/$1">$0</a>',
            $body
        );
           }
 /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }

/**
*
*
*
**/
public function setUsernameAtrribute($username){
        return ucwords($username);
    }


}
