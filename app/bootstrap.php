<?php

/**
 * Global namespace
 *
 * Bootstrap file for
 * application. Basic
 * app loading and
 * set-up process.
 *
 * @author     Ewan Valentine <ewan@pushon.co.uk>
 * @copyright  PushOn 2013
 */
namespace
{   

    use Silex\Provider\MonologServiceProvider, 
        Silex\Provider\TwigServiceProvider,
        Silex\Provider\UrlGeneratorServiceProvider,
        Silex\Provider\HttpCacheServiceProvider,
        Silex\Provider\SessionServiceProvider,
        Silex\Provider\FormServiceProvider,
        Silex\Provider\DoctrineServiceProvider,
        Silex\Provider;

    use Rhodium\Config\DatabaseConfig,
        Rhodium\Helpers\Contacts,
        Rhodium\BaseController,
        Rhodium\BaseModel;

    /** Global functions */

    /** 
    * Cheers to the guys at Message, Brighton 
    * for showing me this cheeky little number. 
    * Though 'd' and 'de' is nicer to shout out 
    * loud than 'take a dump'.
    */

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

    /** Loads base level Silex components */
    $app = new Silex\Application();

    /** Base path */
    $app['base.path'] = __DIR__;

    /** Cache path */
    $app['cache.path'] = __DIR__ . '/cache';

    /** Config path */
    $app['config.path'] = __DIR__ . '/config';

    /** Register session provider */
    $app->register(new SessionServiceProvider());

    /** Register Url generator service provider */
    $app->register(new UrlGeneratorServiceProvider());

    /** Sets Database configuration */
    $dbcfg = new DatabaseConfig();
    $dbcfg->setFilePath( $app );

    $app->register(new DoctrineServiceProvider(), array(
        'db.options' => array(
            'driver' => 'pdo_mysql',
            'host'   => 'localhost',
            'dbname' => 'Rhodium',
            'user'   => 'root',
            'password' => 'drudkh',
            'charset' => 'utf8',
        )
    ));
    
    /** Register Http Cache service */
    $app->register(new HttpCacheServiceProvider());
    $app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

    /** Register mongolog logging service provider */
    $app->register(new MonologServiceProvider(), array(
        'monolog.logfile'       => __DIR__.'/log/app.log',
        'monolog.name'          => 'kp_app',
        'monolog.level'         => 300 // = Logger::WARNING
    ));

    /** Register twig service provider */
    $app->register(new TwigServiceProvider(), array(
        'twig.path'             => array(__DIR__ . '/../src/'),
        'twig.options'          => array(
            'debug' => true,
            'cache' => false, // __DIR__ . '/cache', 
            'strict_variables' => false
        )
    ));

    /** Register form service provider */
    $app->register(new FormServiceProvider());

    $app['app.name'] = 'Main';

    $controller = new BaseController();
    $controller->setApp( $app );

    $model = new BaseModel();
    $model->setApp( $app );

    /** Boots app */
    $app->boot();

    /** Returns Silex\Application as var $app */
    return $app;
}



