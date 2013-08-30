<?php 

namespace Rhodium\Config;

/** Rummage library (xml and json parsing) **/
use Rhodium\Helpers\Rummage;

/**
 * DatabaseConfig 
 *
 * A config class to interface the
 * JSON config file for use for the 
 * DBCore library.
 */
class DatabaseConfig
{
	private static $dbtype;
	private static $dbname;
	private static $dbuser;
	private static $dbpass;
	private static $dbhost;
	private static $json;

	// Configured on app start-up, must be static
	public static $path;

	/**
	 * __construct
	 *
	 * Initialises the JSON parser on
	 * instantiation
	 */
	public function __construct( $path )
	{
		self::$path = $path;
		
		// Initialises the JSON parser. This feels wrong...
		$this->initJSON( self::$path );
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
	public static function setFilePath( $path )
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
	public static function getFilePath()
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
	public static function initJSON()
	{
		self::$json = new Rummage;
		self::$json->setFileLocation(self::getFilePath(), 'db', 'json');
	}

	/**
	 * getDbType
	 *
	 * Retrives the database type
	 * from the JSON config file.
	 * 			
	 * @return string Database type.
	 */
	public static function getDbType()
	{
		self::$dbtype = self::$json->parseJSON()->dbtype;

		return self::$dbtype;
	}

	/**
	 * getDbName
	 *
	 * Retrieves the database name
	 * from the JSON config file.
	 * 
	 * @return string Database name.
	 */
	public static function getDbName()
	{
		self::$dbname = self::$json->parseJSON()->dbname;

		return self::$dbname;
	}

	/**
	 * getDbUser
	 *
	 * Retrieves the database user
	 * from the JSON config file.		
	 * 
	 * @return string Database user.
	 */
	public static function getDbUser()
	{
		self::$dbuser = self::$json->parseJSON()->dbuser;

		return self::$dbuser;
	}

	/**
	 * getDbPass
	 *
	 * Retrieves the database password
	 * from the JSON config file.
	 * 
	 * @return string Database password.
	 */
	public static function getDbPass()
	{
		self::$dbpass = self::$json->parseJSON()->dbpass;

		return self::$dbpass;
	}

	/**
	 * getDbHost
	 *
	 * Retrieves the database host
	 * from the JSON config file.
	 * 
	 * @return string Database host.
	 */
	public static function getDbHost()
	{
		self::$dbhost = self::$json->parseJSON()->dbhost;

		return self::$dbhost;
	}

	/**
	 * databaseParams
	 *
	 * Returns the params as a PHP 
	 * array, for the benefit of
	 * third party ORM libraries.
	 * In our case, Doctrine needs
	 * them in the Bootstrap.
	 *
	 * This way, the json config,
	 * applies globally. 
	 *
	 * Yeah, this is a feature...
	 * 
	 * @return array Database params.
	 */
	public static function databaseParams()
	{

		// Doctrine friendly naming.
		$params = array(
			'driver'   => self::getDbType(),
	        'user'     => self::getDbUser(),
	        'password' => self::getDbPass(),
	        'dbname'   => self::getDbName(),
		);

		return $params;
	}
}