<?php 

namespace Rhodium;

use Silex\Application;
use Rhodium\Helpers\Loader;

/**
 * BaseController
 *
 * Base Controller, controllers don't have to extend
 * the base controller, it's optional. Though,
 * extending the base controller gives users controllers
 * access to core functions, such as the Silex\Application,
 * the resource loaders, the model loader etc.
 *
 * @author 		Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright 	Ewan Valentine 2013
 */
class BaseController
{

	public $model;
	public $view;
	public $helper;
	public $thirdParty;

	protected static $app;

	/**
	 * __construct()
	 *
	 * Sets Application and Loader
	 */
	public function __construct()
	{
		
	}

	public static function setApp( $app )
	{
		self::$app = $app;
	}

	/**
	 * model
	 *
	 * This is the core model loader,
	 * to be used in user controllers.
	 * 
	 * @param  string $model accepts model name
	 * @return object        returns instance of a model
	 */
	public function model( $model, array $params = null )
	{

		$model = explode( ':', $model);

		$modelString = "" . $model[0] . "\Models\\" . $model[1] . "Model";

		$model = new $modelString( $params );

		return $model;
	}

	public function view( $view, $params = null )
	{

		$view = explode( ':', $view );

		$alloy = $view[0];
		$view = $view[1];

		$path = $alloy . '/Views/' . $view . '.html.twig';

		if ( isset( $params ) ) {
			$view = self::$app['twig']->render( $path , $params );
		} else {
			$view = self::$app['twig']->render( $path );
		}

		return $view;
	}

	/**
	 * helper
	 *
	 * @todo  Will be used to load libraries
	 * 
	 * @param  string $helper helper name
	 * @return object         helper object
	 */
	public function helper($helper)
	{

	}

	/**
	 * load
	 *
	 * Loader class for loading files,
	 * media files, config files etc.
	 * 
	 * @param  string $type file sort
	 * @param  string $name file name
	 * @param  string $ext  mime type
	 * @return string       filepath
	 */
	public function load($type, $name, $ext)
	{
		switch ( $type ) {
			case $type == 'image':
				$result = $this->loader->loadImage( $name, $ext );
				break;

			case $type == 'audio':
				$result = $this->loader->loadAudio( $name, $ext );
				break;

			case $type == 'video':
				$result = $this->loader->loadVideo( $name, $ext );
				break;

			case $type == 'xml':
				$result = $this->loader->loadXML( $name );
				break;

			case $type == 'json':
				$result = $this->loader->loadJSON( $name );
				break;

			default:
				$result = 'Incorrect params given';
				break;
		}

		return $result;
	}
}