<?php 

namespace Rhodium\Config;

use Rhodium\Config\iPath;

class Paths implements iPath
{

	protected $_mediaPath;
	protected $_logPath;
	protected $_cachePath;

	public function __construct()
	{

	}

	public function setMediaPath($mediaPath)
	{
		// To write to json file (or YAML?)
		$this->_mediaPath = $mediaPath;
	}

	public function getMediaPath()
	{
		// To pull from json file (or YAML?)
		return $this->_mediaPath = 'web/images';
	}

	public function setLogPath($logPath)
	{
		$this->_logPath = $logPath;
	}

	public function getLogPath()
	{
		return $this->_logPath = '/logs';
	}

	public function setCachePath($cachePath)
	{
		$this->_cachePath = $cachePath;
	}

	public function getCachePath()
	{
		return $this->_cachePath = '/cache';
	}
}