<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

	public function save(Request $request) {

		$name = $request->thumbnail->getClientOriginalName();

		$request->thumbnail->move('thumbnail-image', $name);

		$destinationPath = '/thumbnail-image/' . $name;

		$product = new Product;

		$product->product_name = $request->product_name;

		$product->writer = $request->writer;

		$product->category = $request->category;

		$product->thumbnail = $destinationPath;

		$product->save();

	}

	public function show() {

		$products = Product::all();

		return $products;
	}
}
