<?php 

namespace Rhodium;

class BaseModel
{

	protected static $app;

	public function __construct()
	{
		
	}

	public static function setApp( $app )
	{
		self::$app = $app;
	}
}