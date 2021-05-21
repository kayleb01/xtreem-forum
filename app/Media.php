<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $guarded = [];

    protected $appends = ['ImageUrl'];

    public function model():MorphTo
    {
        return $this->morphTo();
    }

    public function getImageUrlAttribute()
    {
        return url('storage/media/'. $this->user_id.'/'.$this->created_at->format('Y').'/'.$this->created_at->format('m').'/' . $this->filename);
    }
}
