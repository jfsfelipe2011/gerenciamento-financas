<?php

use JFin\Application;
use JFin\ServiceContainer;
use JFin\Plugins\RoutePlugin;
use JFin\Plugins\ViewPlugin;
use JFin\Plugins\DbPlugin;

require_once __DIR__ . '/../vendor/autoload.php';


// Gerendo um novo container de serviço
$serviceContainer = new ServiceContainer();

// Gerendo uma nova instancia da aplicação
$app = new Application($serviceContainer);

// |-------------------------------------------|
// | 	Geração de novos serviços			   |
// |-------------------------------------------|

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

// |-------------------------------------------|
// | 	Geração dos controladores			   |
// |-------------------------------------------|

require_once __DIR__ . '/../src/controllers/category-costs.php';


// Inicializa a aplicação
$app->start();