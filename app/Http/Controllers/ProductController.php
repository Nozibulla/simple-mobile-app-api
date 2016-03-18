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

		$product->book_name = $request->product_name;

		$product->writer = $request->writer;

		$product->book_link = $request->book_link;

		$product->writer_on_linkbar = $this->makeTheTitleLink(strip_tags($request->writer));

		$product->thumbnail = $destinationPath;

		$product->save();

		$categoryIds = $request->input('category');

		$product->categories()->attach($categoryIds);

	}

	public function addCategory() {

		$categories = Category::paginate(20);

		return view('add_category', compact('categories'));

	}

	public function saveCategory(Request $request) {

		$category = new Category;

		$category->name = $request->category;

		$category->name_on_linkbar = $this->makeTheTitleLink(strip_tags($request->category));

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

	public function makeTheTitleLink($link_to_convert) {

		$converted_Link = strtolower($link_to_convert);

		$converted_Link = preg_replace("/[^a-z0-9_\s-]/", "", $converted_Link);

		$converted_Link = preg_replace("/[\s-]+/", " ", $converted_Link);

		$converted_Link = preg_replace("/[\s_]/", "-", $converted_Link);

		return $converted_Link;

	}

}
