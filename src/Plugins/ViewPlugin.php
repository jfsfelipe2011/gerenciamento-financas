<?php
declare(strict_types=1);

namespace JFin\Plugins;

use Interop\Container\ContainerInterface;
use JFin\ServiceContainerInterface;
use JFin\View\Twig\TwigGlobals;
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

			$generator = $container->get('routing.generator');
			$auth = $container->get('auth');

			$twig->addExtension(new TwigGlobals($auth));

			$twig->addFunction(new \Twig_SimpleFunction('route', 
				function (string $name, array $params = []) use ($generator) {
					return $generator->generate($name, $params);
				}));

			return $twig;
		});

		$container->addLazy('view.renderer', function (ContainerInterface $container) {
			$twigEnvironment = $container->get('twig');
			return new ViewRenderer($twigEnvironment);
		});
	}
}