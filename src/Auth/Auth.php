<?php

namespace JFin\Auth;

use JFin\Auth\JasnyAuth;

class Auth implements AuthInterface
{
	/**
	 * [Instancia de JasnyAuth]
	 * @var JFin\Auth\JasnyAuth
	 */
	private $jasnyAuth;

	/**
	 * [Inicializa uma instancia de JasnyAuth]
	 * 
	 * @param JasnyAuth $jasnyAuth [instacia de JansyAuth]
	 */
	public function __construct(JasnyAuth $jasnyAuth)
	{
		$this->jasnyAuth = $jasnyAuth;
	}

	/**
	 * [Login de usuário na aplicação]
	 * 
	 * @param  array  $credentials [usuário e senha]
	 * @return bool  [autenticado ou não]
	 */
	public function login(array $credentials)
	{
		list('email' => $mail, 'password' => $password) = $credentials;
		return $this->jasnyAuth->login($email, $password) !== null;
	}

	/**
	 * [Verifica se o usuário está logado]
	 * 
	 * @return bool [autenticado ou não]
	 */
	public function check()
	{

	}

	/**
	 * [Desloga usuário na aplicação]
	 */
	public function logout()
	{

	}

	/**
	 * [Gera uma senha criptografada]
	 * 
	 * @param  string $password [senha de usuário]
	 * @return String           [senha criptografada]
	 */
	public function hashPassword(string $password)
	{
		return $this->jasnyAuth->hashPassword($password);
	}
}