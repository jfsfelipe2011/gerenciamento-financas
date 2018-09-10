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

	/**
	 * [Gera uma senha criptografada]
	 * 
	 * @param  string $password [senha de usuário]
	 * @return String           [senha criptografada]
	 */
	public function hashPassword(string $password);

	/**
	 * [Retorna informações do Usuário logado]
	 * 
	 * @return UserInterface|null [Interface de usuário ou null]
	 */
	public function user();
}