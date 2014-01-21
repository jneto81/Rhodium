<?php 

/**
 * This is a bodge job in order
 * for the console unit to work.
 *
 * It's not an ideal solution
 * but basically we needed 
 * another instance of $app
 * but to be instantiated
 * all in one file.
 *
 * The core bootstrap file
 * instantiates this other 
 * parts of the application
 * through index.php and 
 * index_dev.php, which 
 * class with the console
 * loader and don't call
 * the $app variable as
 * expected.
 *
 * This is fine for the
 * time being, but 
 * doesn't comply with 
 * the DRY rule.
 *
 * @todo  Sort this out.
 *
 * @author    Ewan Valentine <ewan@pushon.co.uk>
 * @copyright PushOn 2013
 */

ini_set('display_errors', 0);

// Load the libraries
require_once __DIR__.'/../vendor/autoload.php';

use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$app = new Silex\Application();

// Load the controllers
// require __DIR__.'/../src/app.php';

$app['config.path'] = '/config';

/** Base path */
$app['base.path'] = __DIR__;

$dbcfg = new Rhodium\Database\DatabaseConfig();

/** Third party console service provider for Silex */
use Knp\Provider\ConsoleServiceProvider;

$app->register(new ConsoleServiceProvider(), array(
    'console.name'              => 'PushOnConsole',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/'
));

/** Sets Database configuration */
$dbcfg = new Rhodium\Database\DatabaseConfig();

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
                    "path" => "/src/CommentsBundle/Entities",
                    "namespace" => "CommentsBundle\Entities",
                ),
            ),
        ),
    ));

 
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Helper\HelperSet;
 
$helperSet = new HelperSet(array(
    'db' => new ConnectionHelper( $app['orm.em']->getConnection() ),
    'em' => new EntityManagerHelper( $app['orm.em'] )
));
 
ConsoleRunner::run($helperSet);

return $app;
