<?php

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
* Database connection is created based on the parameters defined in the configuration file
*/
$di->setShared('db', function () use ($config) {

    $connection = new DbAdapter(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => 'utf8',
        'port'     => 3306,
        'options'  => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ),
    ));

    return $connection;
});