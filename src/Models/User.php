<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser, UserInterface
{
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password'
	];

	/**
	 * [Retorna o id]
	 * 
	 * @return [int] [identificador do user]
	 */
	public function getId()
	{
		return (int)$this->id;
	}

	/**
	 * [Retorna o username]
	 * 
	 * @return string [email do usuário]
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * [Retorna o password encriptado]
	 * 
	 * @return string [password do usuário]
	 */
	public function getHashedPassword()
	{
		return $this->password;
	}

	public function onLogin()
	{
		// not implements
	}

	public function onLogout()
	{
		// not implements
	}

	/**
	 * [Retorna o nome completo]
	 * 
	 * @return string [nome completo do usuário]
	 */
	public function getFullname()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * [Retorna o e-mail]
	 * @return string [email do usuário]
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * [Retorna o password]
	 * 
	 * @return string [password do usuário]
	 */
	public function getPassaword()
	{
		$this->password;
	}
}