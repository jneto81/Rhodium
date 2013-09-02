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

	public function persist( $object )
	{
		$db = self::$app['db']->insert('blog', $object);
	}
}