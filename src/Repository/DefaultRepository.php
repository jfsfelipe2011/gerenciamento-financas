<?php
declare(strict_types=1);

namespace JFin\Repository;

class DefaultRepository implements RepositoryInterface
{
	/**
	 * [Nome de um modelo]
	 * @var string
	 */
	private $modelClass;

	/**
	 * [Instancia de model]
	 * @var Model
	 */
	private $model;

	/**
	 * [Inicializa um novo modelo]
	 * @param string $modelClass [nome do modelo a ser trabalhado]
	 */
	public function __construct(string $modelClass)
	{
		$this->modelClass = $modelClass;
		$this->model = new $modelClass;
	}

	/**
	 * [Retorna todos os registros]
	 * @return array [todos os registros]
	 */
	public function all()
	{

	}

	/**
	 * [Cria um novo registro]
	 * @param  array  $data [valores para a criação]
	 */
	public function create(array $data)
	{

	}

	/**
	 * [Atualiza um registro]
	 * 
	 * @param  int    $id   [identificador do registro]
	 * @param  array  $data [valores para a atualização]
	 */
	public function update(int $id, array $data)
	{

	}

	/**
	 * [Deleta um registro]
	 * 
	 * @param  int    $id [identificador do registro]
	 */
	public function delete(int $id)
	{

	}
}