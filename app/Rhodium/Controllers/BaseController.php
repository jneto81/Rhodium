<?php 

namespace Rhodium\Controllers;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class BaseController
{
	protected $rd;

	public function __construct( $rd )
	{
		$this->rd = $rd;
	}

	protected function view( $view, $params = null )
    {
        $view = explode( ':', $view );

        $bundle = $view[0];
        $view = $view[1];

        $path = $bundle . '/Views/' . $view . '.html.twig';

        if ( isset( $params ) ) {
                $view = self::$app['twig']->render( $path , $params );
        } else {
                $view = self::$app['twig']->render( $path );
        }

        return $view;
    }
}