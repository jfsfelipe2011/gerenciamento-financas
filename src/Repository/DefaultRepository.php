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
	 * 
	 * @param string $modelClass [nome do modelo a ser trabalhado]
	 */
	public function __construct(string $modelClass)
	{
		$this->modelClass = $modelClass;
		$this->model = new $modelClass;
	}

	/**
	 * [Retorna todos os registros]
	 * 
	 * @return array [todos os registros]
	 */
	public function all()
	{
		return $this->model->all()->toArray();
	}

	/**
	 * [Cria um novo registro]
	 * 
	 * @param  array  $data [valores para a criação]
	 * @return Model [instancia de modelo]
	 */
	public function create(array $data)
	{
		$this->model->fill($data);
        $this->model->save();
        return $this->model;
	}

	/**
	 * [Atualiza um registro]
	 * 
	 * @param  int    $id   [identificador do registro]
	 * @param  array  $data [valores para a atualização]
	 * @return  Model [instancia de modelo]
	 */
	public function update(int $id, array $data)
	{
		$model = $this->find($id);
        $model->fill($data);
        $model->save();
        return $model;
	}

	/**
	 * [Deleta um registro]
	 * 
	 * @param  int    $id [identificador do registro]
	 */
	public function delete(int $id)
	{
		$model = $this->find($id);
        $model->delete();
	}

	/**
	 * [Busca um registro]
	 * 
	 * @param  int    $id 			   [identificador do registro]
	 * @param  bool   $failIfNotExists [deve falhar se não existir o registro ou não]
	 * @return Model      			   [Retorna um unico modelo]
	 */
	public function find(int $id, bool $failIfNotExists = true)
    {
        return $failIfNotExists ? $this->model->findOrFail($id) : $this->model->find($id);
    }

    /**
	 * [Busca um registro por um campo]
	 * 
	 * @param  string $field [campo de busca]
	 * @param  mixed  $value [valor da busca]
	 * @return array  [registro que atendem a busca]
	 */
	public function findByField(string $field, $value)
	{
		return $this->model->where($field, '=', $value)->toArray();
	}
}