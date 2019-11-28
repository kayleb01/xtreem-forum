<?php

namespace App;

//use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Cog\laravel\Ban\Traits\Bannable;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable 
{
   // use HasApiTokens;
    // use Bannable;
    use softDeletes;
    use Notifiable;

    const ADMIN = 1;
    const MODERATOR = 2;
    const USER = 3;

    public function shouldApplyBannedAtScope()

    {

        return true;

    }
protected $dates = ['created_at', 'banned_at', 'updated_at', 'deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'sex', 'location', 'dob'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];
    
    #Relationships
   

    public function comment()
    {
        $this->hasMany(comment::class);
    }

     public function attachment()
    {
        return $this->hasMany(attachment::class);
    }

    public function role(){
        return $this->BelongsTo(Role::class);
    }
    
     public function thread(){
        return $this->hasMany(thread::class);
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

    public function setUsernameAttribute($username){
        return ucwords($username);
    }
}
