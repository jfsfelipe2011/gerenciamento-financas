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
		'date_lauch',
		'name',
		'value',
		'user_id'
	];
}