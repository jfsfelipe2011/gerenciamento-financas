<?php

use JFin\Application;
use JFin\ServiceContainer;
use JFin\Plugins\RoutePlugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());

$app->get('/', function(RequestInterface $request) {
	var_dump($request->getUri());die();
	echo 'Hello World';
});

$app->get('/home/{name}', function(ServerRequestInterface $request) {
	echo $request->getAttribute('name');
});

$app->start();