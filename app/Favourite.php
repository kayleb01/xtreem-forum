<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Favouritable
{
    /**
     * Boot the trait.
     */
    protected $table = "likes";
    protected static function bootFavouritable()
    {
        static::deleting(function ($model) {
            $model->favourites->each->delete();
        });
    }

    /**



    
     * A reply can be favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favourites()
    {
        return $this->morphMany(favourite::class, 'favourited');
    }

    /**
     * favourite the current reply.
     *
     * @return Model
     */
    public function favourite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (! $this->favourites()->where($attributes)->exists()) {
            return $this->favourites()->create($attributes);
        }
    }

    /**
     * Unfavorite the current reply.
     */
    public function unfavourite()
    {
        $attributes = ['user_id' => auth()->id()];

        $this->favourites()->where($attributes)->get()->each->delete();
    }

    /**
     * Determine if the current reply has been favorited.
     *
     * @return bool
     */
    public function isFavourite()
    {
        return (bool) $this->favourites->where('user_id', auth()->id())->count();
    }

    /**
     * Fetch the favorited status as a property.
     *
     * @return bool
     */
    public function getIsFavouritedAttribute()
    {
        return $this->isFavourite();
    }

    /**
     * Get the number of favorites for the reply.
     *
     * @return int
     */
    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
}
