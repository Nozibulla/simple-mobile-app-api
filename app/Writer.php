<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model {
	protected $fillable = [
		'writer',

	];

	public function products() {

		return $this->belongsToMany('App\Product');
	}
}
