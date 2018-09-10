<?php

use JFin\Application;
use JFin\Plugins\AuthPlugin;
use JFin\Plugins\DbPlugin;
use JFin\ServiceContainer;


// Gerendo um novo container de serviço
$serviceContainer = new ServiceContainer();

// Gerendo uma nova instancia da aplicação
$app = new Application($serviceContainer);

// |-------------------------------------------|
// | 	Geração de novos serviços			   |
// |-------------------------------------------|

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;