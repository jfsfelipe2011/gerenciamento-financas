<?php

namespace JFin\Auth;

use JFin\Repository\RepositoryInterface;
use Jasny\Auth;
use Jasny\Auth\Sessions;

class JasnyAuth extends Auth
{
	use Sessions;

	/**
	 * [Interface de Repository]
	 * @var JFin\Repository\RepositoryInterface
	 */
	private $repository;

	/**
	 * [Inicializa um novo repositorio]
	 * 
	 * @param RepositoryInterface $repository [Interface de Repository]
	 */
	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * [Busca usuário pelo id]
	 * 
	 * @param  int $id   [identificador do usuário]
	 * @return User|null [usuário ou não]
	 */
	public function fetchUserById($id)
	{
		return $this->repository->find($id, false);
	}

	/**
	 * [Busca usuário pelo username]
	 * 
	 * @param  string $username [email do usuário]
	 * @return User|null        [usuário ou não]
	 */
	public function fetchUserByUsername($username)
	{
		return $this->repository->findByField('email', $username);
	}
}