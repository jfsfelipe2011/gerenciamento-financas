<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password'
	];
}