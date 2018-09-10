<?php

namespace JFin\Models;

interface UserInterface
{
	/**
	 * [Retorna o id]
	 * 
	 * @return [int] [identificador do user]
	 */
	public function getId();

	/**
	 * [Retorna o nome completo]
	 * 
	 * @return string [nome completo do usuário]
	 */
	public function getFullname();

	/**
	 * [Retorna o e-mail]
	 * 
	 * @return string [email do usuário]
	 */
	public function getEmail();

	/**
	 * [Retorna o password]
	 * 
	 * @return string [password do usuário]
	 */
	public function getPassaword();
}