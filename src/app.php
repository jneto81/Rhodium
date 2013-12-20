<?php 

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
  
$routes = new Routing\RouteCollection();

$routes->add('test', new Routing\Route('/test/{year}', array(
    'year' => null,
    '_controller' => 'TestBundle\\Controllers\\TestController::indexAction',
)));

return $routes;