<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Writer;
use Illuminate\Http\Request;

class ApiController extends Controller {

	public function products() {

		$products = Product::all();

		foreach ($products as $product) {

			$categories = $product->categories;
			$writer = $product->writers;

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

	public function writersWithProducts() {

		$writers = Writer::all();

		foreach ($writers as $writer) {

			$products = $writer->products;

		}

		return (compact('writers'));
	}

	public function productByCategorie(Request $request) {

		$category_name = $request->cat_name;

		$categories = Category::wherename_on_linkbar($category_name)->get();

		foreach ($categories as $category) {

			return $category->products;

		}
	}

	public function writers() {

		$writers = Writer::all();

		return compact('writers');

	}

	public function productsByWriter(Request $request) {

		$writer = $request->writer_name;

		$writers = Writer::wherewriter_on_linkbar($writer)->get();

		foreach ($writers as $writer) {

			return $writer->products;

		}
	}

}
