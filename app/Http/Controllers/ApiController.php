<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

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

		return (compact('categories'));
	}

	public function categoriesWithProducts() {

		$categories = Category::all();

		foreach ($categories as $category) {

			$products = $category->products;

		}

		return (compact('categories'));
	}

	public function productByCategorie(Request $request) {

		$category_name = $request->cat_name;

		$categories = Category::wherename($category_name)->get();

		foreach ($categories as $category) {

			return $category->products;

		}
	}

	public function writers() {

		$writers = Product::distinct()->pluck('writer');

		return $writers;

	}

	public function productsByWriter(Request $request) {

		$writer = $request->writer_name;

		$products = Product::wherewriter($writer)->get();

		return $products;
	}

}
