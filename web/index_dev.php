<?php 
// example.com/web/front.php
 
require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(-1);

use Symfony\Component\HttpFoundation\Request;

$sc = include __DIR__.'/../src/Container.php';
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$request = Request::createFromGlobals();

$response = $sc->get('core')->handle( $request );
 
$response->send();
