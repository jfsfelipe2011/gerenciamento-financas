<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;

class BillPay extends Model
{
	/**
	 * [campos para atribuição em massa]
	 * @var array
	 */
	protected $fillable = [
		'date_lauch',
		'name',
		'value',
		'user_id',
		'category_cost_id'
	];
}