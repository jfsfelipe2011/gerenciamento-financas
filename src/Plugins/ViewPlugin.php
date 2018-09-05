<?php
declare(strict_types=1);

namespace JFin\Plugins;

use JFin\ServiceContainerInterface;
use Interop\Container\ContainerInterface;
use JFin\View\ViewRenderer;

class ViewPlugin implements PluginInterface
{
	/**
	 * [registra o serviço de renderizador de templates]
	 * 
	 * @param  ServiceContainerInterface $container [Interface de container de serviço]
	 */
	public function register(ServiceContainerInterface $container)
	{
		$container->addLazy('twig', function (ContainerInterface $container) {
			$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
			$twig = new \Twig_Environment($loader);
			return $twig;
		});

		$container->addLazy('view.renderer', function (ContainerInterface $container) {
			$twigEnvironment = $container->get('twig');
			return new ViewRenderer($twigEnvironment);
		});
	}
}