<?php 

namespace Rhodium\Config;

/**
 * GeneralConfig
 *
 * Interface for the General config file,
 * for the purpose of storing site wide,
 * general rules and configurations. 
 *
 * @author 	 	Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright  	Ewan Valentine 2013
 */
class GeneralConfig
{

	protected $dateFormat;
	
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
		/** Creates instance of the Rummage class to load JSON files */
		$this->json = new Rummage;

		/** Checks config directory for general.json */
		/** filepath, filename, mime type */
		$this->json->setFileLocation(self::$path, 'general', 'json');
	}

	/**
	 * getDbType
	 *
	 * Retrives the database type
	 * from the JSON config file.
	 * 			
	 * @return string Database type.
	 */
	public function getDateFormat()
	{
		$this->dateFormat = $this->json->parseJSON()->dateFormat;

		return $this->dateFormat;
	}
}