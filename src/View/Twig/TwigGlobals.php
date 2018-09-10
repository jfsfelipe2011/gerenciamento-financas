<?php

namespace JFin\View\Twig;

use JFin\Auth\AuthInterface;

class TwigGlobals extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
	/**
	 * [Instancia de Auth Interface]
	 * @var JFin\Auth\AuthInterface
	 */
	private $auth;

	/**
	 * [Inicializa uma nova instancia de AuthInterface]
	 * 
	 * @param AuthInterface $auth [Interface de Auth]
	 */
	public function __construct(AuthInterface $auth)
	{
		$this->auth = $auth;
	}

	public function getGlobals()
	{
		return [
			'Auth' => $this->auth
		];
	}
}