<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ban extends Model
{
	protected $table = 'bans';

	protected $fillable = [
	'user_id',
	'ban_time',
	'ban_expire_time',
	'reason',
	'ban_by'

	];


	public function user() {
		$this->belongsTo(User::class);
	}




}
