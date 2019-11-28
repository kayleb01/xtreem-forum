<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
  public function user(){
  	$this->belongsTo(User::class);
  }

  public function comment(){
  	$this->belongsTo(comment::class);
  }
}
