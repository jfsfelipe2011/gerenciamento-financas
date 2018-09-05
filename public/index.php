<?php

use JFin\Application;
use JFin\ServiceContainer;
use JFin\Plugins\RoutePlugin;
use JFin\Plugins\ViewPlugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/{name}', function (ServerRequestInterface $request) use ($app) {
	$view = $app->service('view.renderer');
	return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});

$app->start();