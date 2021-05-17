<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

 protected $fillable =['name', 'description'] ;
 protected $table = 'categories';

 public function forums(){
 	return $this->hasMany('App\Forum', 'category_id');
 }

}
