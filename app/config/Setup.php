<?php

use Phalcon\DI;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Crypt;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->set('config', $config);

$di->set('dispatcher', function(){

    $eventsManager = new Phalcon\Events\Manager();

    $eventsManager->attach('dispatch:beforeDispatchLoop', function($event, $dispatcher) {

        $actionName = $dispatcher->getActionName();

        if ($actionName) { // only camelize the name if it has one
        
            $dispatcher->setActionName(Phalcon\Text::camelize($actionName));
        } 
    });

    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath'      => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

require_once("../app/config/DatabaseConfig.php");

$di->set('modelsManager', function() {

  return new Phalcon\Mvc\Model\Manager();
});
 
/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {

    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {

    $session = new SessionAdapter();
    $session->start();

    return $session;
});


$di->set('crypt', function() {

    $crypt = new Crypt();
    $cryptKey = null;

    if (is_null($cryptKey)) {

        echo "Define a crypt key, then delete this";
        die;
    }

    $crypt->setKey($cryptKey);

    return $crypt;
});

$di->setShared('router', function() {
    
    //Use the annotations router
    $router = new \Phalcon\Mvc\Router\Annotations(false);
    $router->removeExtraSlashes(true);

    //Set 404 paths
    $router->notFound(array(
        "controller" => "Error",
        "action"     => "error404"
    ));

    $router->addResource('Index', '/');

    return $router;
});


$di->setShared('transactionManager', function(){

    return new \Phalcon\Mvc\Model\Transaction\Manager();
});

// Assign our new tag a definition so we can call it
$di->set('mtag',  function() {

    return new MyTags();
});

require_once("ServiceRegistration.php");

require_once("DaoRegistration.php");
