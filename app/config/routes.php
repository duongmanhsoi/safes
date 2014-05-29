<?php

$router = new Phalcon\Mvc\Router();
$router->setDefaultController('index');
$router->setDefaultAction('index');

$router->add('/:controller', array(
	'namespace' => 'App\Controllers',
	'controller' => 1
));

return $router;