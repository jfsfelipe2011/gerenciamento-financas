<?php
declare(strict_types=1);

namespace JFin\Plugins;

use JFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{

    /**
     * [Registra o serviço de banco de dados - Eloquent]
     * @param  ServiceContainerInterface $container [Interface para containers de serviços]
     */
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';

        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();
    }
}