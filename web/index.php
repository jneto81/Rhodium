<?php 
// example.com/web/front.php
 
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$sc = include __DIR__.'/../src/Container.php';
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$request = Request::createFromGlobals();

new Rhodium\Controllers\BaseController( $sc );

$response = $sc->get('Core')->handle( $request );
 
$response->send();