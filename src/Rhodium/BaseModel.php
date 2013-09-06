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

	public function persist( $table, $stuff )
	{
		if ( is_array( $stuff ) ) {
			$db = self::$app['db']->insert( $table, $stuff);
		} else {
			$db = self::$app['db']->insert( $table, $stuff);
		}

		if ( $db == true ) {
			return true;
		}

		return false;
	}

	public function fetch( $query, $param )
	{
		$raw = explode( ':', $query );
		$table = $raw[0];
		$column = $raw[1];

		$sql = "SELECT * FROM $table WHERE $column = ? ";

		if ( isset( $column ) ) {
			$db = self::$app['db']->fetchAssoc( $sql, array( $param ) );
		}

		if ( $db == true ) {
			return $db;
		}

		return false;
	}
}