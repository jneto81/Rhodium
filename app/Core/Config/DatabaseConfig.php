<?php 

namespace Core\Config;

/** Rummage library (xml and json parsing) **/
use Core\Helpers\Rummage;

/**
 * DatabaseConfig 
 *
 * A config class to interface the
 * JSON config file for use for the 
 * DBCore library.
 */
class DatabaseConfig
{
	private $dbtype;
	private $dbname;
	private $dbuser;
	private $dbpass;
	private $dbhost;

	// Configured on app start-up, must be static
	public static $path;

	/**
	 * __construct
	 *
	 * Initialises the JSON parser on
	 * instantiation
	 */
	public function __construct()
	{
		// Initialises the JSON parser. This feels wrong...
		$this->initJSON();
	}

	/**
	 * setFilePath
	 *
	 * Sets the file path from the bootstrap on
	 * app start up. Has to be set there to get the 
	 * correct path from the root dir. I.e 
	 * app/config
	 * 			
	 * @param string $path filepath from bootstrap
	 */
	public function setFilePath( $path )
	{
		// This has to be static as it's set via the bootstrap
		self::$path = $path;
	}

	/**
	 * getFilePath
	 *
	 * Simple getter for config filepath
	 * @return string filepath
	 */
	public function getFilePath()
	{
		return self::$path;
	}

	/**
	 * initJSON
	 *
	 * Creates a new instance of Rummage,
	 * Rummage is an XML and JSON parse class.
	 *
	 * In this case it is used to return JSON
	 * config files.
	 */
	public function initJSON()
	{
		$this->json = new Rummage;
		$this->json->setFileLocation(self::$path, 'db', 'json');
	}

	/**
	 * getDbType
	 *
	 * Retrives the database type
	 * from the JSON config file.
	 * 			
	 * @return string Database type.
	 */
	public function getDbType()
	{
		$this->dbtype = $this->json->parseJSON()->dbtype;

		return $this->dbtype;
	}

	/**
	 * getDbName
	 *
	 * Retrieves the database name
	 * from the JSON config file.
	 * 
	 * @return string Database name.
	 */
	public function getDbName()
	{
		$this->dbname = $this->json->parseJSON()->dbname;

		return $this->dbname;
	}

	/**
	 * getDbUser
	 *
	 * Retrieves the database user
	 * from the JSON config file.		
	 * 
	 * @return string Database user.
	 */
	public function getDbUser()
	{
		$this->dbuser = $this->json->parseJSON()->dbuser;

		return $this->dbuser;
	}

	/**
	 * getDbPass
	 *
	 * Retrieves the database password
	 * from the JSON config file.
	 * 
	 * @return string Database password.
	 */
	public function getDbPass()
	{
		$this->dbpass = $this->json->parseJSON()->dbpass;

		return $this->dbpass;
	}

	/**
	 * getDbHost
	 *
	 * Retrieves the database host
	 * from the JSON config file.
	 * 
	 * @return string Database host.
	 */
	public function getDbHost()
	{
		$this->dbhost = $this->json->parseJSON()->dbhost;

		return $this->dbhost;
	}
}