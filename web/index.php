<?php
ini_set('display_errors', 0);

// Create the application
$app = require __DIR__.'/../app/bootstrap.php';

$app['http_cache']->run();