<?php 

namespace Rhodium\Helpers;

class RandomHelper
{
	public function randomString( $length )
	{
		$string = substr( 
			str_shuffle( 
				'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 
			0, $length );

		return $string;
	}
}