<?php
declare(strict_types=1);

namespace JFin;

use JFin\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\RedirectResponse;

class Application
{
	/**
	 * [$serviceContainer Container de serviços]
	 * @var ServiceContainerInterface
	 */
	private $serviceContainer;

	/**
	 * [barreiras para acesso a aplicação]
	 * @var array
	 */
	private $before = [];

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

	/**
	 * [Adiciona rotas do tipo get]
	 * 
	 * @param  string   $path   [caminho da rota]
	 * @param  callable $action [ação executada pela rota]
	 * @param  string 	$name   [nome da rota]
	 * @return JFin\Application [Interface fluente]
	 */
	public function get($path, $action, $name = null)
	{
		$routing = $this->service('routing');
		$routing->get($name, $path, $action);
		return $this;
	}

	/**
	 * [Adiciona rotas do tipo post]
	 * 
	 * @param  string   $path   [caminho da rota]
	 * @param  callable $action [ação executada pela rota]
	 * @param  string 	$name   [nome da rota]
	 * @return JFin\Application [Interface fluente]
	 */
	public function post($path, $action, $name = null)
	{
		$routing = $this->service('routing');
		$routing->post($name, $path, $action);
		return $this;
	}

	/**
	 * [redirecionamento para uma rota]
	 * 
	 * @param  string $path [caminho ser redirecionado]
	 * @return \Zend\Diactoros\Response\RedirectResponse [Objeto de redirecionamento]
	 */
	public function redirect($path)
	{
		return new RedirectResponse($path);
	}

	/**
	 * [redirecionamento para rota através do nome]
	 * 
	 * @param  string $name   [nome da rota]
	 * @param  array  $params [parametros da rota]
	 * @return \Zend\Diactoros\Response\RedirectResponse [Objeto de redirecionamento]
	 */
	public function route(string $name, array $params = [])
	{
		$generator = $this->service('routing.generator');
		$path = $generator->generate($name, $params);

		return $this->redirect($path);
	}

	/**
	 * [Gera uma nova resposta]
	 * @param  ResponseInterface $response [Interface de Response]
	 */
	protected function emitResponse(ResponseInterface $response)
	{
		$emitter = new SapiEmitter();
		$emitter->emit($response);
	}

	/**
	 * [Armazena as barreiras de aplicação]
	 * 
	 * @param  callable $callback [função para a restrição]
	 * @return JFin\Application [Interface fluente]
	 */
	public function before(callable $callback)
	{
		array_push($this->before, $callback);
		return $this;
	}

	/**
	 * [Executa as barreiras de aplicação]
	 * 
	 * @return ResponseInterface|null [Returna ou nao uma insterface de resposta]
	 */
	protected function runBefores()
	{
		foreach ($this->before as $callback) {
		    $result = $callback($this->service(RequestInterface::class));

		    if ($result instanceof ResponseInterface) {
		    	return $result;
		    }
		}

		return null;
	}

	/**
	 * [Inicia a aplicação]
	 */
	public function start()
	{
		$route = $this->service('route');

		$request = $this->service(RequestInterface::class);

		if(!$route) {
			echo "Page not found";
			exit;
		}

		foreach ($route->attributes as $key => $value) {
			$request = $request->withAttribute($key, $value);
		}

		$result = $this->runBefores();

		if ($result) {
			$this->emitResponse($result);
			return;
		}

		$callable = $route->handler;
		$response = $callable($request);
		$this->emitResponse($response);
	}
}