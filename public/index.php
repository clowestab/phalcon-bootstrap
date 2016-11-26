<?php

$isProduction = null;

if (is_null($isProduction)) {

    echo "Define as to whether this is a production environment or not then delete this";

    die;
}

//If we are not in a development environment
if ($isProduction) {

    define('PRODUCTION', 1);

} else {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

use Phalcon\Mvc\Application,
    Phalcon\Events\Manager as EventsManager,
    Micro\Messages\Auth;

try {

    include __DIR__ . "/../app/config/Configuration.php";
    $config = new \Phalcon\Config($config);

    define('BASE_URL', $config->baseUrl);
    define('FILE_BASE', realpath(__DIR__ . "/.."));

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/FileLoader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/Setup.php";

    //Create and bind the DI to the application
    $app = new Application($di);

    echo $app->handle()->getContent();

} catch(\Phalcon\Exception $e) {

     echo "PhalconException: ", $e->getMessage();
}