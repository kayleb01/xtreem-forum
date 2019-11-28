<?php

namespace App\filter;

use App\User;

class ThreadFilters extends Filter
{
	
	protected $filter = ['username', 'trending', 'new'];

	public function username($username){
		$user = User::where('username', $username)->firstOrFail();
		return $this->builder->where('user_id', $user);
	}

	public function trending(){
		$this->builder->getQuerty()->orders = [];
		return $this->builder->orderBy('replies_count', 'desc');
	}


	public function new(){
		$this->builder->getQuery()->orders = [];
		return $this->builder->orderBy('created_at', 'desc');
	}
}