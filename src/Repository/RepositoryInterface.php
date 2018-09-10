<?php
declare(strict_types=1);

namespace JFin\Repository;

interface RepositoryInterface
{
	/**
	 * [Retorna todos os registros]
	 * @return array [todos os registros]
	 */
	public function all();

	/**
	 * [Cria um novo registro]
	 * @param  array  $data [valores para a criação]
	 */
	public function create(array $data);

	/**
	 * [Atualiza um registro]
	 * 
	 * @param  int    $id   [identificador do registro]
	 * @param  array  $data [valores para a atualização]
	 */
	public function update(int $id, array $data);

	/**
	 * [Deleta um registro]
	 * 
	 * @param  int    $id [identificador do registro]
	 */
	public function delete(int $id);

	/**
	 * [Busca um registro]
	 * 
	 * @param  int    $id 			   [identificador do registro]
	 * @param  bool   $failIfNotExists [deve falhar se não existir o registro ou não]
	 * @return Model      			   [Retorna um unico modelo]
	 */
	public function find(int $id, bool $failIfNotExists = true);

	/**
	 * [Busca um registro por um campo]
	 * 
	 * @param  string $field [campo de busca]
	 * @param  mixed  $value [valor da busca]
	 * @return mixed  		 [registros que atendem a busca]
	 */
	public function findByField(string $field, $value);
}