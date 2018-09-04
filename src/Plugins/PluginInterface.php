<?php

namespace JFin\Plugins;

use JFin\ServiceContainerInterface;

interface PluginInterface
{
	/**
	 * [Registra um novo plugin]
	 * @param  ServiceContainerInterface $container [Interface para containers de serviços]
	 */
	public function register(ServiceContainerInterface $container);
}