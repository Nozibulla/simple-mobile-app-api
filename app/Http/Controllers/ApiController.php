<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;

class ApiController extends Controller {

	public function products() {

		$products = Product::all();

		foreach ($products as $product) {

			$categories = $product->categories;

		}

		return (compact('products'));

	}

	public function categories() {

		$categories = Category::all();

		foreach ($categories as $category) {

			$products = $category->products;

		}

		return (compact('categories'));
	}

}
