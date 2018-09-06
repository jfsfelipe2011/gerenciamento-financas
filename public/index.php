<?php

use JFin\Application;
use JFin\ServiceContainer;
use JFin\Plugins\RoutePlugin;
use JFin\Plugins\ViewPlugin;
use JFin\Plugins\DbPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

$app->get('/category-costs', function () use($app) {
    $view = $app->service('view.renderer');

    $model = new \JFin\Models\CategoryCost();
    $categories = $model->all();

    return $view->render('category-costs/list.html.twig', [
    	'categories' => $categories
    ]);
});


$app->start();