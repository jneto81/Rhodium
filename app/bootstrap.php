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

    require_once __DIR__.'/../vendor/autoload.php';

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

    use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

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

    $app->register( new DoctrineServiceProvider, array (
        "db.options" => array(
            'driver'    => 'pdo_mysql',
            'host'      => $dbcfg->dbhost,
            'dbname'    => $dbcfg->dbname,
            'user'      => $dbcfg->dbuser,
            'password'  => $dbcfg->dbpass,
            'charset'   => 'utf8',
        ),
    ));

    $app->register( new DoctrineOrmServiceProvider, array (
        "orm.em.options" => array(
            "mappings" => array(
                array(
                    "type" => "annotation",
                    "path" => "/../src/Main/Entities",
                    "namespace" => "Main\Entities",
                ),
            ),
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

    /** Register form service provider */
    $app->register( new FormServiceProvider() );

    /** Third party console service provider for Silex */
    use Knp\Provider\ConsoleServiceProvider;
    use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
    use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
    use Symfony\Component\Console\Helper\HelperSet;
     
    $app['helperSet'] = new HelperSet(array(
        'db' => new ConnectionHelper( $app['orm.em']->getConnection() ),
        'em' => new EntityManagerHelper( $app['orm.em'] )
    ));

    $app['app.name'] = 'Main';

    $controller = new BaseController();
    $controller->setApp( $app );

    $model = new BaseModel();
    $model->setApp( $app );

    $app['crypto'] = new Rhodium\Helpers\Security\Mcrypt();
    $app['validate'] = new Rhodium\Helpers\ValidationHelper();

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