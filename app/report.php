<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
  protected $guarded = [];
  public function user(){
  return	$this->belongsTo(User::class);
  }

  public function comment(){
  	return $this->belongsTo(comment::class);
  }

  public function thread(){
    return $this->belongsTo(thread::class);
  }
}
