<?php

namespace Rhodium;

use Rhodium\Database\DBCore;

class BaseModel
{

	protected static $app;

	public function __construct()
	{
		$this->db = new DBCore();
	}

	public static function setApp( $app )
	{
		self::$app = $app;
	}

	protected function persist( $object )
	{

		/** @todo need some kind of generic object persistence */
		foreach ( $object as $value ) {
			d( $value );
		}
	}
}