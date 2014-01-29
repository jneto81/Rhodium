<?php

/**
 * Global namespace
 *
 * Bootstrap file for
 * application. Basic
 * app loading and
 * set-up process.
 *
 * @author     Ewan Valentine <ewan.valentine@gmail.co.uk>
 * @copyright  Ewan Valentine 2013
 */
namespace
{   
    require_once __DIR__.'/../vendor/autoload.php';

    /** Silex Core */
    use Silex\Provider,
        Silex\Provider\TwigServiceProvider,
        Silex\Provider\FormServiceProvider,
        Silex\Provider\MonologServiceProvider, 
        Silex\Provider\SessionServiceProvider,
        Silex\Provider\DoctrineServiceProvider,
        Silex\Provider\HttpCacheServiceProvider,
        Silex\Provider\UrlGeneratorServiceProvider,
        Silex\Provider\ServiceControllerServiceProvider;

    /** Symfony Components */
    use Symfony\Component\Config\FileLocator,
        Symfony\Component\Routing\RouteCollection,
        Symfony\Component\Console\Helper\HelperSet,
        Symfony\Component\Routing\Loader\YamlFileLoader,
        Symfony\Component\ExpressionLanguage\Expression,
        Symfony\Component\DependencyInjection\ContainerBuilder,
        Symfony\Component\DependencyInjection\Loader\YamlFileLoader as ContainerYamlLoader;

    /** Doctrine */
    use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper,
        Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

    /** Misc Third party */
    use Knp\Provider\ConsoleServiceProvider,
        Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

    /**
     * Debuger no exit
     * @param  mixed $arg input from debug caller
     * @return mixed      var_dump();
     */
    function d( $arg )
    {
        var_dump( $arg );
    }

    /**
     * Debuger with exit
     * @param  mixed $arg input from debug caller with exit
     * @return mixed      var_dump() exit;
     */
    function de( $arg )
    {
        var_dump( $arg );
        exit;
    }

    /** Bootstrap */
    $container = new ContainerBuilder();
    $loader = new ContainerYamlLoader( $container, new FileLocator( __DIR__ . '/config/' ) );
    $loader->load('services.yml');
    $app = $container->get( 'silex.app' );
    $app['env'] = 'dev';

    $app['base.controller'] = $container->get( 'base.controller' );
    $app['container'] = $container;

    /** Base path */
    $app['base.path'] = __DIR__;

    /** Cache path */
    $app['cache.path'] = __DIR__ . '/cache';

    /** Config path */
    $app['config.path'] = __DIR__ . '/config';
    
    /** Register session provider */
    $app->register( new SessionServiceProvider() );

    /** Register Url generator service provider */
    $app->register( new UrlGeneratorServiceProvider() );

    $app->register( new DerAlex\Silex\YamlConfigServiceProvider( __DIR__ . "/config/database_{$app['env']}.yml" ) );
    $app->register( new DerAlex\Silex\YamlConfigServiceProvider( __DIR__ . "/config/doctrine.yml" ) );

    $app->register( new DoctrineServiceProvider, array (
        "db.options" => array( $app['env'] => $app['config']['database'] )
    ));

    d( $app['config']['entities'] );

    $app->register( new DoctrineOrmServiceProvider, array (
        "orm.em.options" => array(
           $app['config']['entities']
        ),
    ));

    /** Register Http Cache service */
    $app->register( new HttpCacheServiceProvider() );
    $app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

    /** Register mongolog logging service provider */
    $app->register(new MonologServiceProvider(), array(
        'monolog.logfile'       => __DIR__.'/log/app.log',
        'monolog.name'          => 'kp_app',
        'monolog.level'         => 300 // = Logger::WARNING
    ));

    $app['routes'] = $app->extend('routes', function ( RouteCollection $routes, $app ) {
        $loader     = new YamlFileLoader( new FileLocator(__DIR__ . '/config' ) );
        $collection = $loader->load( 'routes.yml' );
        $routes->addCollection( $collection );
        return $routes;
    });
    
    $app->register( new ServiceControllerServiceProvider() ); 

    /** Register twig service provider */
    $app->register( new TwigServiceProvider(), array(
        'twig.path'             => __DIR__ . '/../src/',
        'twig.options'          => array(
            'debug' => true,
            'cache' => false, // __DIR__ . '/cache', 
            'strict_variables' => false
        )
    ));

    $app['helperSet'] = new HelperSet(array(
        'db' => new ConnectionHelper( $app['orm.em']->getConnection() ),
        'em' => new EntityManagerHelper( $app['orm.em'] )
    ));

    $app->register( new ConsoleServiceProvider(), array(
        'console.name'              => 'Rhodium Console',
        'console.version'           => '1.0.0',
        'console.project_directory' => __DIR__.'/',
    ));

    /** Boots app */
    $app->boot();

    /** Returns Silex\Application as var $app */
    return $app;
}