<?php 

namespace Rhodium\Helpers;

use Rhodium\Helpers\Security\Mcrypt;

class ValidationHelper
{
	public function __construct()
	{
		$this->mcrypt = new Mcrypt;
	}

	public function mcrypt( $string, $salt )
	{
		return $this->mcrypt( $string, $salt );
	}

	public function nohtml( $value )
	{
		$value = htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' );

		return $value;
	}

	/**
	 * stripWhiteSpaces
	 *
	 * Basic function to remove whitespaces.
	 * Kept this in the base controllers
	 * as it could be commonly used.
	 * 
	 * @param  string $value Value to strip.
	 * @return string        Whitespace free.
	 */
	public function trim( $value )
	{
		return $trimmed = trim( $value );
	}

	public function range( $min, $max, $value )
	{
		$length = strlen( $value );

		if( $length >= $min && $length <= $max ) {
			return $value;
		} else {
			return new \Exception ( 'Out of range.' );
		}
	}

	public function removeSpecialCharacters( $value )
	{
		$stripped = preg_replace( '/[a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string );

		return $stripped;
	}

	public function email( $email )
	{		
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
	
		if ( preg_match( $regex, $email ) ) {
		 	return $email;
		}

		return new \Exception( 'Invalid e-mail address.' );
	}

	public function ukpc( $postCode )
	{

	}
}