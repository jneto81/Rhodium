<?php

namespace Rhodium;

use Rhodium\Database\DBCore;

/**
 * BaseModel
 *
 * The base model class handles 
 * lower level database abstraction
 * for classes which extend it.
 *
 * @author  	Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright 	Ewan Valentine 2013
 */
class BaseModel
{

	protected static $app;

	public function __construct()
	{
		/** @todo this could be DI'd, use a IoC */
		$this->db = new DBCore();
	}

	public static function setApp( $app )
	{
		self::$app = $app;
	}

	public function persist( $table, $stuff )
	{		
		if ( is_array( $stuff ) ) {
			$db = self::$app['db']->insert( $table, $stuff );
		}

		if ( $db == true ) {
			return true;
		}

		return false;
	}

	public function fetch( $query, $param = null)
	{
		$raw = explode( ':', $query );
		$table = $raw[0];
		$column = $raw[1];

		if ( $column == '*' ) {
			$sql = "SELECT * FROM $table";
		} else {
			$sql = "SELECT * FROM $table WHERE $column = ? ";
		}

		if ( isset( $column ) ) {
			$db = self::$app['db']->fetchAll( $sql, array( $param ) );
		}

		if ( $db == true ) {
			return $db;
		}

		return false;
	}
}