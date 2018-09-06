<?php

use JFin\Application;
use JFin\ServiceContainer;
use JFin\Plugins\RoutePlugin;
use JFin\Plugins\ViewPlugin;
use JFin\Plugins\DbPlugin;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

$app
	->get('/category-costs', function () use ($app) {
	    $view = $app->service('view.renderer');

	    $model = new \JFin\Models\CategoryCost();
	    $categories = $model->all();

	    return $view->render('category-costs/list.html.twig', [
	    	'categories' => $categories
	    ]);
	}, 'category-costs.list')
	->get('/category-costs/new', function () use ($app) {
		$view = $app->service('view.renderer');
		return $view->render('category-costs/create.html.twig');
	}, 'category-costs.new')
	->post('/category-costs/store', function (ServerRequestInterface $request) use ($app) {
		$data = $request->getParsedBody();
		\JFin\Models\CategoryCost::create($data);

		return $app->route('category-costs.list');
	}, 'category-costs.store');


$app->start();