<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app->match('/alloy/main', static function() use ( $app ) {
	return new Response( 'Alloy/main' );
});