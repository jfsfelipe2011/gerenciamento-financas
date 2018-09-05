<?php
declare(strict_types=1);

namespace JFin\View;

interface ViewRendererInterface
{
	/**
	 * [renderiza o template]
	 * 
	 * @param  string $template [nome do template]
	 * @param  array  $context  [variáveis de contexto do template]
	 */
	public function render(string $template, array $context = []);
}