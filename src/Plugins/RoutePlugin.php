<?php

namespace JFin\Plugins;

use JFin\ServiceContainerInterface;
use Aura\Router\RouterContainer;
use Zend\Diactoros\ServerRequestFactory;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

class RoutePlugin implements PluginInterface
{
	/**
	 * [registra o serviço de rotas]
	 * 
	 * @param  ServiceContainerInterface $container [Interface de container de serviço]
	 */
	public function register(ServiceContainerInterface $container)
	{
		$routerContainer = new RouterContainer();

		/* Registra as rotas da aplicação */
		$map = $routerContainer->getMap();
		/* Tem a função de identificar a rota que está sendo acessada */
		$matcher = $routerContainer->getMatcher();
		/* Tem a função de gerar links com base nas rotas registradas */
		$generator = $routerContainer->getGenerator();
		$request = $this->getRequest();

		$container->add('routing', $map);
		$container->add('routing.matcher', $matcher);
		$container->add('routing.generator', $generator);
		$container->add(RequestInterface::class, $request);

		$container->addLazy('route', function (ContainerInterface $container) {
			$matcher = $container->get('routing.matcher');
			$request = $container->get(RequestInterface::class);
			return $matcher->match($request);
		});
	}

	/**
	 * [Pega todas as variaveis globais da aplicação]
	 * @return mixed
	 */
	protected function getRequest()
	{
		return ServerRequestFactory::fromGlobals(
			$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
		);
	}
}