<?php 

namespace App\filter;

use Illuminate\Http\Request;

abstract class Filter{
/**
**@var request
**
**/
protected $request;

/**
**@var Builder
**/
protected $builder;

/**
** @var Filters 
that we'll operate on
*/
protected $filters = [];

/**
**Instantiate the threat instance
**@param Request $request
**/
public function __construct(Request $request){
	$this->request = $request;
}

/**
	**
	**@param Illuminate\Database\Eloquent\Builder $builder
	**@var Illuminate\Database\Eloquent\Builder
**/
public function apply($builder){
	$this->builder = $builder;

	foreach ($this->getFilters() as $filter => $value) {
		if(method_exist($this, $filter)){
			$this->$filter($value);
		}
	}
	return $this->$builder;
}

/**
**@return array
**
**/

public function getFilters(){
	return array_filter($this->request->only($this->filters));
}


}