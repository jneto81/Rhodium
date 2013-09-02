<?php 

namespace YourAppName;
// See that namespace? Call it something that means something to you
// or you application. Just like we named our core 'Rhodium'.
// 'cos it's precious and shit.

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
	$controller = new Controllers\HomeController( $app );	
	$content = $controller->ourPage();

	return new Response ( $content );
});

$app->match('/shop', function() use ( $app ) {
	$controller = new \Bullion\Controllers\BasketController();
	$content = $controller->storeBasket();

	return new Response( $content );
});