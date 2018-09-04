<?php
declare(strict_types=1);

namespace JFin;

interface ServiceContainerInterface
{
	/**
	 * [Adiciona um serviço ao container]
	 * 
	 * @param string $name [nome do serviço]
	 * @param $service 	   [serviço incluido no container]
	 */
	public function add(string $name, $service);

	/**
	 * [Adiciona um serviço de forma retardada]
	 * 
	 * @param string   $name     [nome do serviço]
	 * @param callable $callable [função para a inclusão do servico]
	 */
	public function addLazy(string $name, callable $callable);

	/**
	 * [busca um serviço no container]
	 * 
	 * @param  string $name [nome do serviço]
	 * @return mixed        [serviço]
	 */
	public function get(string $name);

	/**
	 * [verifica se existe um determinado serviço no container]
	 * 
	 * @param  string  $name [nome do serviço]
	 * @return boolean       [verdade se existe e falso se não]
	 */
	public function has(string $name);
}