<?php

namespace App\Http\Controllers;

use App\Product;

class ApiController extends Controller {

	public function show() {

		$products = Product::all();

		return $products;
	}
}
