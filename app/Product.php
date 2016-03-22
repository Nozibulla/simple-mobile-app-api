<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
		'book_name',
		'writer',
		'book_link',
		'writer_id',
		'category',
		'thumbnail',
	];

	public function categories() {

		return $this->belongsToMany('App\Category')->withTimestamps();
	}

	public function getCategoryListAttribute() {

		return $this->categories->lists('id')->toArray();
	}

	public function writer() {

		return $this->belongsTo('App\Writer');
	}
}
