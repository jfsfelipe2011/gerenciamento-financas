<?php

declare(strict_types = 1);

namespace JFin\Repository;

use Illuminate\Support\Collection;
use JFin\Models\BillPay;
use JFin\Models\BillReceive;

class StatementRepository implements StatementRepositoryInterface
{
	/**
	 * [Extrato do usuário]
	 * 
	 * @param  string $dateStart [data de inicio da consulta]
	 * @param  string $dateEnd   [data de fim da consulta]
	 * @param  int    $userId    [identificador do registro]
	 * @return array             [registros de extrato do usuário]
	 */
	public function all(string $dateStart, string $dateEnd, int $userId)
	{
		$billPays = BillPay::query()
						->selectRaw('bill_pays.*, category_costs.name as category_name')
						->leftJoin('category_costs', 'category_costs.id', '=', 'bill_pays.category_cost_id')
						->whereBetween('date_lauch', [$dateStart, $dateEnd])
						->where('bill_pays.user_id', $userId)
						->get();

		$billReceives = BillReceive::query()
								->whereBetween('date_lauch', [$dateStart, $dateEnd])
								->where('user_id', $userId)
								->get();

		$collection = new Collection(array_merge_recursive($billPays->toArray(), $billReceives->toArray()));
		$statements = $collection->sortByDesc('date_lauch');

		return [
			'statements' 	 => $statements,
			'total_pays' 	 => $billPays->sum('value'),
			'total_receives' => $billReceives->sum('value')
		];
	}
}