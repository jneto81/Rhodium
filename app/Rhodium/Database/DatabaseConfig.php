<?php 

namespace Rhodium\Database;

/**
 * DatabaseConfig 
 *
 * @author  	Ewan Valentine 2013
 * @copyright 	Rhodium 2013
 */
class DatabaseConfig
{
	public $dbtype;
	public $dbname;
	public $dbuser;
	public $dbpass;
	public $dbhost;

	/**
	 * __construct
	 *
	 * Initialises the JSON parser on
	 * instantiation
	 */
	public function __construct()
	{
		$this->dbaldt = 'pdo_mysql';
		$this->dbtype = 'mysql';
		$this->dbname = 'boutique';
		$this->dbuser = 'root';
		$this->dbpass = '';
		$this->dbhost = 'localhost';
	}

	/**
	 * databaseParams
	 *
	 * @return array Database params.
	 */
	public function databaseParams()
	{

		// Doctrine friendly naming.
		$params = array(
			'driver'   => $this->dbaldt,
	        'user'     => $this->dbuser,
	        'password' => $this->dbpass,
	        'dbname'   => $this->dbname,
		);

		return $params;
	}
}