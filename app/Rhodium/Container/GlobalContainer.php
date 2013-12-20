<?php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
 
$rd = new DependencyInjection\ContainerBuilder();
$rd->register('context', 'Symfony\Component\Routing\RequestContext');

$rd->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('context')))
;

$rd->register('resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');
 
$rd->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher')))
;
$rd->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('UTF-8'))
;
$rd->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Calendar\\Controller\\ErrorController::exceptionAction'))
;
$rd->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
;
$rd->register('core', 'Rhodium\Core')
    ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;
 
$rd->register('listener.string_response', 'Rhodium\StringResponseListener');
$rd->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
;

$rd->register('twig.path', 'Twig_Loader_String' );

$rd->register('twig', 'Twig_Environment' )
   ->setArguments( array( new Reference( 'twig.path' ) ) );

$rd->register('base.controller', 'Rhodium\Controllers\BaseController')
   ->addMethodCall('view', array( new Reference 'twig' ) );

return $rd;