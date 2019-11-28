<?php 
 
 namespace App\inspection;

use Exception;

 class invalidKeyWords{

protected $keywords = [
'ref?id', 'yahoo customer support'
];


/**
**@param String
**@throws \Exception
**Detect spam
**/
public function detect($body){
	foreach ($this->keywords as $keyword) {
		if(stripos($body, $keyword) !== false){
			throw new Exception("Your post contains Spam");
			
		}
	}
}


 }









