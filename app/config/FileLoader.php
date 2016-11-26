<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->constantsDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
        $config->application->servicesDir,
        $config->application->daoDir,
        $config->application->helpersDir,
        $config->application->inputModelsDir,
        $config->application->inputValidatorsDir,
        $config->application->exceptionsDir,
        $config->application->viewModelsDir,
    )
)->register();

// Use composer autoloader to load vendor classes
// require_once __DIR__ . '/../../vendor/autoload.php';