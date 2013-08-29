<?php 

namespace Core\Helpers;

/**
 * FileHelper
 *
 * Basic class for loading, saving
 * editing files. Also for
 * checking basic file and folder
 * access rights.
 *
 * @author    Ewan Valentine <ewan@pushon.co.uk>
 * @copyright PushOn 2013
 */
class FileHelper
{
	protected $filePath;

	/**
	 * setFilePath
	 *
	 * Set the file path.
	 * 
	 * @param string $filePath Filepath.
	 */
	public function setFilePath($filePath)
	{
		$this->filePath = $filePath;
	}

	/**
	 * getFilePath
	 *
	 * Get file path.
	 * 
	 * @return string 
	 */
	public function getFilePath()
	{
		return $this->filePath;
	}

	/**
	 * getIsDir
	 *
	 * Check if path is a directory.
	 * 
	 * @return boolean
	 */
	public function checkIsDir()
	{
		return is_dir( $this->getFilePath() );
	}

	/**
	 * checkDirWriteable
	 *
	 * Checks if a directory
	 * is writable.
	 * 
	 * @return boolean 
	 */
	public function checkDirWriteable()
	{
		return is_writable( $this->getFilePath() );
	}

	public function saveFile($data)
	{
		if( file_put_contents( $this->getFilePath(), $data ) ) {
			return true;
		}
	}

	public function getFile()
	{
		if( $content = file_get_contents( $this->getFilePath() ) ) {
			return $content;
		}
	}
}