<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Writer;
use Illuminate\Http\Request;

class ProductController extends Controller {

	public function __construct() {

		$this->middleware('auth');
	}

	public function showBooks() {

		$products = Product::paginate(50);

		foreach ($products as $product) {

			$categories = $product->categories;
			$writer = $product->writers;

		}

		return view('books_list', compact('products'));
	}

	public function addProduct() {

		$categories = Category::lists('name', 'id');

		$writers = Writer::lists('writer', 'id');

		return view('welcome', compact('categories', 'writers'));
	}

	public function save(Request $request) {

		$name = $request->thumbnail->getClientOriginalName();

		$request->thumbnail->move('thumbnail-image', $name);

		$destinationPath = 'http://eboimela.optimumccl.com/thumbnail-image/' . $name;

		$product = new Product;

		$product->book_name = $request->book_name;

		$product->book_link = $request->book_link;

		/*$product->writer = $request->writer;

		$product->writer_on_linkbar = $this->makeTheTitleLink(strip_tags($request->writer));*/

		$product->thumbnail = $destinationPath;

		$product->save();

		$categoryIds = $request->input('category');

		$product->categories()->attach($categoryIds);

		$writerId = $request->input('writer');

		$product->writers()->attach($writerId);

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

		$category->name_on_linkbar = $this->makeTheTitleLink(strip_tags($request->name));

		$category->save();
	}

	public function deleteCategory(Request $request) {

		$id = $request->id;

		$category = Category::findOrFail($id);

		$category->delete();

	}

	public function addWriter() {

		$writers = Writer::paginate(20);

		return view('add_writer', compact('writers'));

	}

	public function saveWriter(Request $request) {

		$writer = new Writer;

		$writer->writer = $request->writer;

		$writer->writer_on_linkbar = $this->makeTheTitleLink(strip_tags($request->writer));

		$writer->save();

	}

	public function saveEditedWriter(Request $request) {

		$id = $request->id;

		$writer = Writer::findOrFail($id);

		$writer->writer = $request->writer;

		$writer->writer_on_linkbar = $this->makeTheTitleLink(strip_tags($request->writer));

		$writer->save();
	}

	public function deleteWriter(Request $request) {

		$id = $request->id;

		$writer = Writer::findOrFail($id);

		$writer->delete();

	}

	public function deleteBook(Request $request) {

		$id = $request->id;

		$book = Product::findOrFail($id);

		$book->delete();
	}

	public function editProduct($id) {

		$book = Product::findOrFail($id);

		$categories = Category::lists('name', 'id');

		$writers = Writer::lists('writer', 'id');

		return view('edit_book', compact('book', 'categories', 'writers'));
	}

	public function makeTheTitleLink($link_to_convert) {

		$converted_Link = strtolower($link_to_convert);

		$converted_Link = preg_replace("/[^অ-ঁ০-৯ীূৃa-z0-9_\s-]/", "", $converted_Link);

		$converted_Link = preg_replace("/[\s-]+/", " ", $converted_Link);

		$converted_Link = preg_replace("/[\s_]/", "-", $converted_Link);

		return $converted_Link;

	}

}
