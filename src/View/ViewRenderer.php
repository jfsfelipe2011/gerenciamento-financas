<?php

namespace JFin\View;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class ViewRenderer implements ViewRendererInterface
{
	/**
	 * [$twigEnvironment renderizador do twig]
	 * @var \Twig_Environment
	 */
	private $twigEnvironment;

	/**
	 * [instancia de um render do twig]
	 * @param \Twig_Environment $twigEnvironment [render do twig]
	 */
	function __construct(\Twig_Environment $twigEnvironment)
	{
		$this->twigEnvironment = $twigEnvironment;
	}

	/**
	 * [renderiza o template]
	 * 
	 * @param  string $template [nome do template]
	 * @param  array  $context  [variáveis de contexto do template]
	 * @return Zend\Diactoros\Response  [resposta com o template renderizado]
	 */
	public function render(string $template, array $context = [])
	{
		$result = $this->twigEnvironment->render($template, $context);
		$response = new Response();
		$response->getBody()->write($result);
		return $response;
	}
}