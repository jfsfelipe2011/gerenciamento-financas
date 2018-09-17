<?php
declare(strict_types=1);

namespace JFin\Plugins;

use Illuminate\Database\Capsule\Manager as Capsule;
use Interop\Container\ContainerInterface;
use JFin\Models\BillPay;
use JFin\Models\BillReceive;
use JFin\Models\User;
use JFin\Repository\CategoryCostRepository;
use JFin\Repository\RepositoryFactory;
use JFin\Repository\StatementRepository;
use JFin\ServiceContainerInterface;

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

        $container->add('repository.factory', new RepositoryFactory());

        $container->addLazy(
            'category-cost.repository', function () {
                return new CategoryCostRepository();
            }
        );

        $container->addLazy(
            'user.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(User::class);
            }
        );

        $container->addLazy(
            'bill-receive.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillReceive::class);
            }
        );

        $container->addLazy(
            'bill-pay.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillPay::class);
            }
        );

        $container->addLazy(
            'statements.repository', function () {
                return new StatementRepository();
            }
        );
    }
}