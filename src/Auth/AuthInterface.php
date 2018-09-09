<?php
declare(strict_types=1);

namespace JFin\Auth;

interface AuthInterface
{
	/**
	 * [Login de usuário na aplicação]
	 * 
	 * @param  array  $credentials [usuário e senha]
	 * @return bool  [autenticado ou não]
	 */
	public function login(array $credentials);

	/**
	 * [Verifica se o usuário está logado]
	 * 
	 * @return bool [autenticado ou não]
	 */
	public function check();

	/**
	 * [Desloga usuário na aplicação]
	 */
	public function logout();
}