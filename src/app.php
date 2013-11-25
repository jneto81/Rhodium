<?php 


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Request::enableHttpMethodParameterOverride();

/** Load package specific routes */
// require_once('BundleName/Routes/BundleNameRoutes.php');

/** Homepage */
$app->match('/', function() use ( $app ) {

	$controller = new Main\Controllers\HomeController();	
	$content = $controller->ourPage();

	return new Response ( $content );
});

/** Homepage */
$app->match('/home', function() use ( $app ) {

	$controller = new Main\Controllers\HomeController();	
	$content = $controller->ourPage();

	return new Response ( $content );
});