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
    DEFINE('DS', DIRECTORY_SEPARATOR);

    use Silex\Provider,
        Silex\Provider\TwigServiceProvider,
        Silex\Provider\FormServiceProvider,
        Silex\Provider\MonologServiceProvider, 
        Silex\Provider\SessionServiceProvider,
        Silex\Provider\DoctrineServiceProvider,
        Silex\Provider\SecurityServiceProvider,
        Silex\Provider\HttpCacheServiceProvider,
        Silex\Provider\TranslationServiceProvider,
        Silex\Provider\UrlGeneratorServiceProvider,
        Silex\Provider\ServiceControllerServiceProvider,
        Silex\Provider\SwiftmailerServiceProvider;

    use Symfony\Component\Config\FileLocator,
        Symfony\Component\Routing\RouteCollection,
        Symfony\Component\Routing\Loader\YamlFileLoader;

    use Rhodium\Database\DatabaseConfig,
        Rhodium\BaseController,
        Rhodium\BaseModel;

    use Ruckuus\Silex\ActiveRecordServiceProvider;

    /** Global functions */

    /** 
    * Cheers to the guys at Message, Brighton 
    * for showing me this cheeky little number. 
    * 'd' and 'de' is nicer to shout out 
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
    $app->register( new SessionServiceProvider() );

    /** Register Url generator service provider */
    $app->register( new UrlGeneratorServiceProvider() );

    $app->register( new TranslationServiceProvider(), array(
        'translator.messages' => array(),
    ));


    $twitter = array (
        'consumer_key'        => '',
        'consumer_secret'     => '',
        'access_token'        => '',
        'access_token_secret' => '',
    );

    /** Sets Database configuration */
    $dbcfg = new DatabaseConfig();

    $app->register( new ActiveRecordServiceProvider(), array(
        'ar.model_dir' => __DIR__ . '.',
        'ar.connections' =>  array ( 'development' => 'mysql://'.$dbcfg->dbuser.':'.$dbcfg->dbpass.'@'.$dbcfg->dbhost.'/'.$dbcfg->dbname ),
        'ar.default_connection' => 'development',
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

    // $app->register( new SecurityServiceProvider() );

    // $app['security.firewalls'] = array (
    //     'admin' => array (
    //         'pattern' => '^/admin/',
    //         'form'    => array (
    //             'login_path' => '/login',
    //             'check_path' => '/login/check'
    //         ),
    //     ),
    // );

    // $app['security.providers'] = array (
    //     'main' => array (
    //         'entity' => array (
    //             'class'     => 'Users\UserProvider',
    //             'property'  => 'email'
    //         ),
    //     ),
    // );

    $twigPaths = array (
        __DIR__ . '/../src/',
        __DIR__ . '/../vendor/rhodium/rhodium-cms/src/Rhodium/CMS/',
        __DIR__ . '/../vendor/rhodium/rhodium-bullion/src/Rhodium/Bullion/',
        __DIR__ . '/../vendor/rhodium/rhodium-crm/src/Rhodium/CRM/',
        __DIR__ . '/../vendor/rhodium/rhodium-crm/src/Rhodium/CRM/',
    );

    foreach ( $twigPaths as $path ) {
        if ( is_dir( $path ) ) {
            $paths[] = $path;
        }
    }


    /** Register twig service provider */
    $app->register( new TwigServiceProvider(), array(
        'twig.path'             => $paths,
        'twig.options'          => array(
            'debug' => true,
            'cache' => false, // __DIR__ . '/cache', 
            'strict_variables' => false
        )
    ));

    $app->register( new SwiftmailerServiceProvider() );

    // $app['swiftmailer.options'] = array(
    //     'host' => 'host',
    //     'port' => '25',
    //     'username' => '',
    //     'password' => '',
    //     'encryption' => null,
    //     'auth_mode' => null
    // );

    // Use: 
    //     $message = \Swift_Message::newInstance()
    //         ->setSubject( 'Feedback' )
    //         ->setFrom( 'Nob \'ead' )
    //         ->setTo( 'person@gmail.com' )
    //         ->setBody( $app['request']->get('message') );
    //     $app['mailer']->send( $message );

    /** Register form service provider */
    $app->register( new FormServiceProvider() );

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