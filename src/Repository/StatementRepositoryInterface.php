<?php

declare(strict_types = 1);

namespace JFin\Repository;

interface StatementRepositoryInterface
{
	/**
	 * [Extrato do usuário]
	 * 
	 * @param  string $dateStart [data de inicio da consulta]
	 * @param  string $dateEnd   [data de fim da consulta]
	 * @param  int    $userId    [identificador do registro]
	 * @return array             [registros de extrato do usuário]
	 */
	public function all(string $dateStart, string $dateEnd, int $userId);
}