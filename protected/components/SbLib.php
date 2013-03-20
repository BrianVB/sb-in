<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class SbLib extends CComponent 
{
	/**
	 * Get a random string for the passed in number of characters. Defaults to 40.
	 * Used for the login key for cookie security whenever logging in
	 * @return string a string of the specified length
	 */
	static function getKeyStr($len = 40){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';    
		for ($p = 0; $p < $len; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;	
	}
}