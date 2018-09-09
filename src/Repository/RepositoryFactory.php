<?php
declare(strict_types=1);

namespace JFin\Repository;

class RepositoryFactory
{
	/**
	 * [Fabrica de repositorios]
	 * 
	 * @param  string $modelClass [nome da classe de modelo]
	 * @return Repository  [Default repository]
	 */
    public static function factory(string $modelClass)
    {
        return new DefaultRepository($modelClass);
    }
}