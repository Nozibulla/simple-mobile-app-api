<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

	public function __construct() {

		$this->middleware('auth');
	}

	public function addProduct() {

		$categories = Category::lists('name', 'id');

		return view('welcome', compact('categories'));
	}

	public function save(Request $request) {

		$name = $request->thumbnail->getClientOriginalName();

		$request->thumbnail->move('thumbnail-image', $name);

		$destinationPath = 'http://eboimela.optimumccl.com/thumbnail-image/' . $name;

		$product = new Product;

		$product->product_name = $request->product_name;

		$product->writer = $request->writer;

		//$product->category = $request->category;

		$product->thumbnail = $destinationPath;

		$product->save();

		$category = $request->input('category');

		$product->categories()->attach($category);

	}

	public function addCategory() {

		$categories = Category::paginate(20);

		return view('add_category', compact('categories'));

	}

	public function saveCategory(Request $request) {

		$category = new Category;

		$category->name = $request->category;

		$category->save();

	}

	public function saveEditedCategory(Request $request) {

		$id = $request->id;

		$category = Category::findOrFail($id);

		$category->name = $request->name;

		$category->save();
	}

	public function deleteCategory(Request $request) {

		$id = $request->id;

		$category = Category::findOrFail($id);

		$category->delete();

	}

}
