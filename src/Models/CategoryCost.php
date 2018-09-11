<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCost extends Model
{
	/**
	 * [campos para atribuição em massa]
	 * @var array
	 */
	protected $fillable = [
		'name',
		'user_id'
	];
}