<?php 

namespace Rhodium;

use Silex\Application;
use Rhodium\Helpers\Loader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Request::enableHttpMethodParameterOverride();

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

	protected $app;

	/**
	 * __construct()
	 */
	public function __construct()
	{

	}

	public function setApp( Application $app )
	{
		$this->app = $app;
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

		$model = explode( ':', $model );

		$modelString = "" . $model[0] . "\Entities\\" . $model[1];

		$model = new $modelString( $params );

		return $model;
	}

	public function view( $view, $params = null )
	{
		$view = explode( ':', $view );

		$bundle = $view[0];
		$view = $view[1];

		$path = $bundle . '/Views/' . $view . '.html.twig';

		if ( isset( $params ) ) {
			$view = $this->app['twig']->render( $path , $params );
		} else {
			$view = $this->app['twig']->render( $path );
		}

		return $view;
	}
}