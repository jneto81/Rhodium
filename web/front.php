<?php 
// example.com/web/front.php
 
require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(-1);

use Symfony\Component\HttpFoundation\Request;
 
$request = Request::createFromGlobals();

$routes = include __DIR__.'/../src/app.php';
$sc = include __DIR__.'/../src/Container.php';

$core = new Rhodium\Core( $routes );
$core->handle( $request )->send();