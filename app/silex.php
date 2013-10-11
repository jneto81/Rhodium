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

// Create the application
// $app = require __DIR__.'/../app/bootstrap.php';

$app = new Silex\Application();

// Load the controllers
// require __DIR__.'/../src/app.php';

$app['config.path'] = '/config';

/** Base path */
$app['base.path'] = __DIR__;

/** Third party console service provider for Silex */
use Knp\Provider\ConsoleServiceProvider;

$app->register(new ConsoleServiceProvider(), array(
    'console.name'              => 'PushOnConsole',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/'
));

return $app;
