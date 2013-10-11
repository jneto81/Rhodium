<?php 


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/** Load package specific routes */
require_once('Alloy/Routes/Main.php');

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

$app->match('/form', function() use( $app ) {

	$controller = new Main\Controllers\HomeController();
	$content 	= $controller->form();

	return new Response ( $content );
});