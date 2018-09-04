<?php
declare(strict_types=1);

namespace JFin;

use JFin\Plugins\PluginInterface;

class Application
{
	/**
	 * [$serviceContainer Container de serviços]
	 * @var ServiceContainerInterface
	 */
	private $serviceContainer;

	/**
	 * [Injeção de dependencia de uma interface de Container de serviço]
	 * 
	 * @param ServiceContainerInterface $serviceContainer [Interface para container de serviço]
	 */
	public function __construct(ServiceContainerInterface $serviceContainer)
	{
		$this->serviceContainer = $serviceContainer;
	}

	/**
	 * [Busca um serviço no container]
	 * 
	 * @param  string $name [nome de um serviço]
	 * @return mixed        [serviço]
	 */
	public function service($name)
	{
		return $this->serviceContainer->get($name);
	}

	/**
	 * [Adiciona um novo serviço ao container]
	 * 
	 * @param string $name    [nome do serviço]
	 * @param mixed  $service [serviço a ser adicionado]
	 */
	public function addService(string $name, $service)
	{
		if(is_callable($service)) {
			$this->serviceContainer->addLazy($name, $service);
		} else {
			$this->serviceContainer->add($name, $service);
		}
	}

	/**
	 * [registra um plugin no container]
	 * 
	 * @param  PluginInterface $plugin [Interface para plugins]
	 */
	public function plugin(PluginInterface $plugin)
	{
		$plugin->register($this->serviceContainer);
	}
}