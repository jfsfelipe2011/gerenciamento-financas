<?php

declare(strict_types = 1);

namespace JFin\Repository;

use JFin\Models\CategoryCost;

class CategoryCostRepository extends DefaultRepository implements CategoryCostRepositoryInterface
{
	/**
	 * [Construtor pai]
	 */
	public function __construct()
	{
		parent::__construct(CategoryCost::class);
	}

	/**
	 * [Soma o valor das categorias por um periodo]
	 * 
	 * @param  string $dateStart [data de inicio da pesquisa]
	 * @param  string $dateEnd   [data final da pesquisa]
	 * @param  int    $userId    [identificador do usuário]
	 * @return array             [Total de valores de categorias de custo somadas]
	 */
	public function sumByPeriod(string $dateStart, string $dateEnd, int $userId)
	{
		$categories = CategoryCost::query()
							->selectRaw('category_costs.name, sum(value) as value')
							->leftJoin('bill_pays', 'bill_pays.category_cost_id', '=', 'category_costs.id')
							->whereBetween('bill_pays.date_launch', [$dateStart, $dateEnd])
							->where('category_costs.user_id', $userId)
							->whereNotNull('bill_pays.category_cost_id')
							->groupBy('bill_pays.value')
							->groupBy('category_costs.name')
							->get();

		return $categories->toArray();					
	}
}