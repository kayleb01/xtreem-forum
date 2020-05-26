<?php

namespace App;

//use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Cog\laravel\Ban\Traits\Bannable;
//use Laravel\Passport\HasApiTokens;
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

    protected $appends = ['isFollowed'];
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
        return $this->hasMany(comment::class, 'user_id');
    }

     public function attachment()
    {
        return $this->hasMany(attachment::class);
    }

    public function role(){
        return $this->BelongsTo(Role::class);
    }
     
    public function follow()
    {
        return $this->hasMany(Follow::class);
    }
     public function thread(){
        return $this->hasMany(thread::class)->latest();
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

    public function getIsFollowedAttribute()
    {
        return Follow::where('user_id', $this->id)->exists();
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
