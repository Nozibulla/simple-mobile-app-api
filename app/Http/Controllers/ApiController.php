<?php

namespace App\Http\Controllers;

use App\Category;
use App\Enduser;
use App\Product;
use App\Writer;
use Hash;
use Illuminate\Http\Request;

class ApiController extends Controller {

	public function products() {

		$products = Product::all();

		foreach ($products as $product) {

			$categories = $product->categories;
			$writer = $product->writer;

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

			$products = $category->products;

			return compact('products');

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

			$products = $writer->products;

			return compact('products');

		}
	}

	public function userSignUP(Request $request) {

		$enduser = new Enduser;

		$enduser->username = $request->username;

		$enduser->email = $request->email;

		$enduser->mobile = $request->mobile;

		$enduser->pass = bcrypt($request->pass);

		$enduser->save();

		return 'saved';

	}

	public function userLogin(Request $request) {

		$username = $request->username;

		$pass = $request->pass;

		$endusers = Enduser::where('username', '=', $username)->get();

		if ($endusers->first()) {

			foreach ($endusers as $enduser) {

				$hashedPass = $enduser->pass;
			}

			if (Hash::check($pass, $hashedPass)) {

				return 'Login successful';

			} else {

				return 'Wrong password';
			}

		} else {

			return 'wrong username';
		}

	}

}
