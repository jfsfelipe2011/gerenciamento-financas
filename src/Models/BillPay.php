<?php

namespace JFin\Models;

use Illuminate\Database\Eloquent\Model;
use JFin\Models\CategoryCost;

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

	public function categoryCost()
	{
		return $this->belongsTo(CategoryCost::class);
	}
}