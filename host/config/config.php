<?php

define('domain', 'http://hangdep.com/safe/');

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => '210.245.90.229',
        'username' => 'hangdep_safe',
        'password' => 'm123456m',
        'name' => 'hangdep_safe',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir' => __DIR__ . '/../../app/models/',
        'viewsDir' => __DIR__ . '/../../app/views/',
        'baseUri' => '/safe/'
    )
));
