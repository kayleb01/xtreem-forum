<?php 

namespace App\Rules;

use Exception;
use App\inspection\spam;

/**
*@param $attribute
*@param $value
 * Determine if our spam check is checked
 */
class SpamFree
{
	
	public function passes($attribute, $value)
	{
		try {
			return ! resolve(spam::class)->detect($value);

		} catch (Exception $e) {
			return false;
		}
	}
}