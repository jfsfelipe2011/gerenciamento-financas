<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;

class BillReceive extends Model
{
	/**
	 * [campos para atribuição em massa]
	 * @var array
	 */
	protected $fillable = [
		'date_launch',
		'name',
		'value',
		'user_id'
	];
}