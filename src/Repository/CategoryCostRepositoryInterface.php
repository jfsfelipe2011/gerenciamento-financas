<?php

declare(strict_types = 1);

namespace JFin\Repository;

interface CategoryCostRepositoryInterface
{
	/**
	 * [Soma o valor das categorias por um periodo]
	 * 
	 * @param  string $dateStart [data de inicio da pesquisa]
	 * @param  string $dateEnd   [data final da pesquisa]
	 * @param  int    $userId    [identificador do usuário]
	 * @return array             [Total de valores de categorias de custo somadas]
	 */
	public function sumByPeriod(string $dateStart, string $dateEnd, int $userId);
}