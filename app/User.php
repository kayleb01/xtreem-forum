<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use App\Follow;


class User extends Authenticatable
{
   // use HasApiTokens;
    // use Bannable;
    use softDeletes;
    use Notifiable;


protected $dates = ['created_at', 'banned_at', 'updated_at', 'deleted_at', 'dob'];

//protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'sex', 'location', 'dob', 'role', 'avatar', 'username', 'confirmation_token'];

    protected $appends = ['isAdmin'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean'
    ];
 /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     *  The attributes that should be used for eager loading
     */

//protected   $with = ['comment', 'thread'];

#Relationships
    public function comment()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

     public function attachment()
    {
        return $this->hasMany(attachment::class);
    }

    public function role(){
        return $this->BelongsTo(Role::class, 'role');
    }

    // public function follow()
    // {
    //     return $this->hasMany(Follow::class);
    // }

     public function thread(){
        return $this->hasMany(thread::class)->latest();
    }

    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')
            ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')
            ->withTimestamps();
    }

     /**
     * Fetch the last published reply for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastReply()
    {
        return $this->hasOne(comment::class)->latest();
    }

        /**
     * Mark the user's account as confirmed.
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;

        $this->save();
    }

     /*
    * Define the Users Role
    */
    public function isAdmin():bool
    {
         return $this->role()->where('role', 'Admin')->exists();
    }

    public function moderator():bool
    {
        if ($this->role()->role = 'Moderator') {
            return true;
          }
         return false ;
    }

    public function user():bool
    {
        if ($this->role()->role = 'User') {
            return true;
          }
         return false ;
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }


    /**
     * Get all activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

/**
     * Record that the user has read the given thread.
     *
     * @param Thread $thread
     */
    public function read($thread)
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }

    public function getIsFollowingAttribute()
    {
        return $this->following()->where('follower_id', auth()->id());
    }
/**
     * Get the cache key for when a user reads a thread.
     *
     * @param  Thread $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }


}
