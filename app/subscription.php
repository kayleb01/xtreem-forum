<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\threadUpdated;

class subscription extends Model
{
  use RecordsActivity;
   protected $guarded = [];
   public function thread()
   {
   	return $this->belongsTo(thread::class);
   }

    public function user()
   {
   	return $this->belongsTo(User::class);
   }

   public function comment()
   {
   	return $this->belongsTo(comment::class);
   }

    public function notify($comment)
    {
        $this->user->notify(new threadUpdated($this->thread, $comment));
    }
}
