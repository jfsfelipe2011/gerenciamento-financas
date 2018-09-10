<?php
declare(strict_types=1);

namespace JFin\Plugins;

use Interop\Container\ContainerInterface;
use JFin\Auth\Auth;
use JFin\Auth\JasnyAuth;
use JFin\ServiceContainerInterface;

class AuthPlugin implements PluginInterface
{

    /**
     * [Registra o serviço de autenticação de usuário]
     * 
     * @param  ServiceContainerInterface $container [Interface para containers de serviços]
     */
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function (ContainerInterface $container) {
            return new JasnyAuth($container->get('user.repository'));
        });

        $container->addLazy(
            'auth', function (ContainerInterface $container) {
                return new Auth($container->get('jasny.auth'));
            }
        );
    }
}