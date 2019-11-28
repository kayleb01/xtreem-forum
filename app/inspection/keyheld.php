<?php 

namespace App\inspection;

use Exception;

class keyheld{

/**
**@param String
**@throw \Exception
**/

public function detect($body){
	
		if(preg_match('/(.)\\1{4,}/', $body)){
			throw new Exception("Your Reply contains Spam");
			
		}
	}




}