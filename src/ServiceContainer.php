<?php

namespace JFin;

use Xtreamwayz\Pimple\Container;

class ClassName implements ServiceContainerInterface
{
	/**
	 * [$container instancia de um container]
	 * @var Xtreamwayz\Pimple\Container
	 */
	private $container;

	/**
	 * [Criação de um novo container]
	 */
	public function __construct()
	{
		$this->container = new Container();
	}

	/**
	 * [Adiciona um serviço ao container]
	 * 
	 * @param string $name [nome do serviço]
	 * @param $service 	   [serviço incluido no container]
	 */
	public function add(string $name, $service)
	{
		$this->container[$name] = $service;
	}

	/**
	 * [Adiciona um serviço de forma retardada]
	 * 
	 * @param string   $name     [nome do serviço]
	 * @param callable $callable [função para a inclusão do servico]
	 */
	public function addLazy(string $name, callable $callable)
	{
		$this->container[$name] = $this->container->factory($callable);
	}

	/**
	 * [busca um serviço no container]
	 * 
	 * @param  string $name [nome do serviço]
	 * @return mixed        [serviço]
	 */
	public function get(string $name)
	{
		return $this->container->get($name);
	}

	/**
	 * [verifica se existe um determinado serviço no container]
	 * 
	 * @param  string  $name [nome do serviço]
	 * @return boolean       [verdade se existe e falso se não]
	 */
	public function has(string $name)
	{
		return $this->container->has($name);
	}
}