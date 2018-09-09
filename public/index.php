<?php

use JFin\Application;
use JFin\Plugins\AuthPlugin;
use JFin\Plugins\DbPlugin;
use JFin\Plugins\RoutePlugin;
use JFin\Plugins\ViewPlugin;
use JFin\ServiceContainer;

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
$app->plugin(new AuthPlugin());

// |-------------------------------------------|
// | 	Geração dos controladores			   |
// |-------------------------------------------|

require_once __DIR__ . '/../src/controllers/category-costs.php';
require_once __DIR__ . '/../src/controllers/users.php';
require_once __DIR__ . '/../src/controllers/auth.php';


// Inicializa a aplicação
$app->start();