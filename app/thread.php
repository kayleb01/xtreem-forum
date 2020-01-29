<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Filters\ThreadFilters;
use App\Events\ThreadRecievedNewReply;
use App\subscription;
use App\like;
use Purify;
use Illuminate\Support\Str;

class thread extends Model
{
	use RecordsActivity;
    use likableTrait;
    
//**Don't apply mass assignment protection    
protected $guarded = [];
protected $with = ['user', 'category', 'creator'];

 /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'locked' => 'boolean',
        'pinned' => 'boolean'
    ];
    
 protected static function boot()
    {
        parent::boot();
        static::deleting(function ($thread) {
            if($thread->comment->count() > 1){
                $thread->comment->each->delete();}
            
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);

            event(new ThreadWasPublished($thread));

        });
    }

 /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/{$this->slug}";
    }

    /**
     * Add a comment to the thread.
     *
     * @param  array $comment
     * @return Model
     */
    public function AddComment($comment)
    {
        $comment = $this->comment()->create($comment);
        event(new ThreadRecievedNewReply($comment));

        return $comment;
    }




//Files uploaded in comments
    //
public function attachment()
{
    return $this->hasMany(attachment::class);
}

 public function like(){
        return $this->hasMany(like::class, 'likable_id');
    }

public function creator(){
	return $this->belongsTo(User::class, 'user_id');
}

public function user(){
	return $this->belongsTo(User::class);
}

public function forum(){
	return $this->belongsTo(Forum::class, 'forum_id');
}

// Belong to categories
public function category(){
	return $this->belongsTo(Categories::class, 'cat_id');
}

public function comment(){
	return $this->hasMany(comment::class);
}

public function notifyReplies($comment){
	//Notify that a reply has been added...
	event(new ThreadRecievedNewReply($comment));

	return $comment;
}

public function subscription(){
	return $this->hasMany(subscription::class);
}


//apply all relevant filters to the thread
public function addFilters($query, threadFilters $filters){
	return $filters->apply($query);
}


//users subscription to threads
public function subscribe($userID = NULL){	
	 $this->subscription()->create([
		'user_id'       => $userID ?: auth()->id()
	]);
	 return $this;
}

public function unsub($userID = NULL){
	return $this->subscription()
				->where('user_id', $userID ?:auth()->id())
				->delete();
}
//Check if the user is subscribed
public function getIsSubscribedToAttribute(){
	 if (! auth()->id()) {
            return false;
        }
        return $this->subscription()
            ->where('user_id', auth()->id())
            ->exists();
    
}

public function hasBeenUpdatedUser($user){
	$key = $user->visitedThreadCacheKey($this);
	return $this->updated_at > cache($key);
}

public function getRouteNameKey()
{
	return 'slug';
}

// public function getBodyAttribute($body)
// {
// 	return \Purify::clean(nl2br($body));
// }

public function setSlugAttribute($value){

	if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
}
public function getTitleAttribute($title)
{
	return ucwords($title);
}

public function toSearchableArray()
    {
        return $this->toArray() + ['path' => $this->path()];
    }

}
