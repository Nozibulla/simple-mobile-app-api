<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
		'product_name',
		'writer',
		'category',
		'thumbnail',
	];
}
