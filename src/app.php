<?php 


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/** Homepage */
$app->match('/', function() use ( $app ) {

	/** 
	 * Load the controller to match the URL to.
	 * I'm also passing in the global app variable
	 * which will allow us to access some of the 
	 * global functions that come with Silex.
	 **/
	$controller = new Main\Controllers\HomeController( $app );	
	$content = $controller->ourPage();

	return new Response ( $content );
});
