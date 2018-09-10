<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser
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
}