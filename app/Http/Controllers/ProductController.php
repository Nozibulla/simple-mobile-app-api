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

		$products = Product::all();

		foreach ($products as $product) {

			$categories = $product->categories;
			$writer = $product->writer;

			// return $writer;

		}

		// return $writer;

		return view('books_list', compact('products', 'categories', 'writer'));
	}

	public function addProduct() {

		$categories = Category::lists('name', 'id');

		$writers = Writer::lists('writer', 'id');

		return view('add_book', compact('categories', 'writers'));
	}

	public function save(Request $request) {

		$book = $request->book->getClientOriginalName();

		$request->book->move('uploaded-book', $book);

		$thumbnailimage = $request->thumbnail->getClientOriginalName();

		$request->thumbnail->move('thumbnail-image', $thumbnailimage);

		$thumbnailPath = 'http://eboimelaapi.eboimelabd.com/thumbnail-image/' . $thumbnailimage;

		$bookPath = 'http://eboimelaapi.eboimelabd.com/uploaded-book/' . $book;

		$product = new Product;

		$product->book_name = $request->book_name;

		$product->book_link = $bookPath;

		$product->writer_id = $request->input('writer');

		$product->thumbnail = $thumbnailPath;

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

	public function updateProduct($id, Request $request) {

		$product = Product::findOrFail($id);

		if ($request->book) {

			$book = $request->book->getClientOriginalName();

			$request->book->move('uploaded-book', $book);

			$bookPath = 'http://eboimelaapi.eboimelabd.com/uploaded-book/' . $book;

			$product->book_link = $bookPath;
		}

		if ($request->thumbnail) {

			$name = $request->thumbnail->getClientOriginalName();

			$request->thumbnail->move('thumbnail-image', $name);

			$destinationPath = 'http://eboimelaapi.eboimelabd.com/thumbnail-image/' . $name;

			$product->thumbnail = $destinationPath;
		}

		$product->book_name = $request->book_name;

		// $product->book_link = $request->book_link;

		$product->writer_id = $request->input('writer');

		$product->update();

		$categoryIds = $request->input('category_list');

		$product->categories()->sync($categoryIds);

		return redirect('book_list');

	}

	public function makeTheTitleLink($link_to_convert) {

		$converted_Link = strtolower($link_to_convert);

		$converted_Link = preg_replace("/[^অ-ঁ০-৯ীূৃa-z0-9_\s-]/", "", $converted_Link);

		$converted_Link = preg_replace("/[\s-]+/", " ", $converted_Link);

		$converted_Link = preg_replace("/[\s_]/", "-", $converted_Link);

		return $converted_Link;

	}

}
