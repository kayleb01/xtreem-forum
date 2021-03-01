<?php

namespace App\inspection;

class spam{

/**
**@var array
**/
protected $inspections = [
invalidKeyWords::class,
keyheld::class
];

/**
**@param String
**@return bool
	Detect Spam
**/
public function detect($body){
	foreach ($this->inspections as $inspection) {
		app($inspection)->detect($body);
	}
	return false;
	}
}