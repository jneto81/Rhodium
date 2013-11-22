<?php 

namespace Rhodium\Helpers;

/**
 * Rummage
 *
 * JSON and XML interpreter. 
 * Rummages around XML and JSON files
 * and returns them as readable php data.
 *
 * @author 		Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright  	Ewan Valentine 2013
 */
class Rummage
{

	public $data;
	public $file;
	public static $app;
	public static $configPath;

	public static function setConfigPath( $app )
	{
		self::$configPath = $app['config.path'];
	}

	public static function getConfigPath()
	{
		return self::$configPath;
	}

	/**
	 * setFileLocation
	 *
	 * Setter for the file location. 
	 * Combines path, filename and mime type.
	 * 
	 * @param string $path Filepath.
	 * @param string $name Filename.
	 * @param string $ext  File mime type.
	 */
	public function setFileLocation( $path, $name, $ext )
	{
		$this->file = $path . '/' . $name . '.' . $ext;
	}

	/**
	 * getFileLocation
	 *
	 * Returns file location.
	 * 
	 * @return string Full file path.
	 */
	public function getFileLocation()
	{
		return $this->file;
	}

	/**
	 * parseJSON
	 *
	 * Gets json file, returns content
	 * as an object.
	 * 
	 * @return object Object of json data from file.
	 */
	public function parseJSON()
	{
		$this->data = file_get_contents( $this->getFileLocation() );
		
		return json_decode( $this->data );
	}

	public function parseJSONAsArray()
	{
		$this->data = file_get_contents( $this->getFileLocation() );

		return json_decode( $this->data, true );
	}

	public function parseXMLFile()
	{

		$this->data = $this->getFileLocation();

		$this->xml = simplexml_load_file( $this->data );

		return $this->xml;
	}

	public function parseXMLUrl()
	{
		$this->data = $this->getFileLocation();

		$this->data = $this->sanitiseXML( $this->data );

		$this->xml = simplexml_load_string( $this->data );

		return $this->xml;

	}

	public function parseXMLFileAsArray()
	{
		
	}

	public function sanitiseXML($url)
	{
		$this->data = file_get_contents( $this->getFileLocation() );

		foreach ( $http_response_header as $header ) {
			if ( preg_match('#^Content-Type: text/xml; charset(.*)#i', $header, $m) )
			{
				switch ( strtolower( $m[1] ) )
				{
					case 'utf-8':
						// B'reet
						break;

					case 'is-8859-1':
						$this->data = utf8_encode( $this->data );
						break;

					default: 
						$this->data = iconv( $m[1], 'utf-8', $this->data );
				}
				break;
			}
		}

		return $this->data;
	}
}