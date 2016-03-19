<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
		'book_name',
		'writer',
		'book_link',
		'category',
		'thumbnail',
	];

	public function categories() {

		return $this->belongsToMany('App\Category')->withTimestamps();
	}

	public function writers() {

		return $this->belongsToMany('App\Writer');
	}
}
