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

		$products = Product::take(30)->orderBy('id','desc')->get();

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

		$username = $request->username;

		$email = $request->email;

		$mobile = $request->mobile;

		$pass = bcrypt($request->pass);

		if ($username && $email && $mobile && $pass) {

			$enduser = new Enduser;

			$enduser->username = $username;

			$enduser->email = $email;

			$enduser->mobile = $mobile;

			$enduser->pass = $pass;

			$enduser->save();

			$login['status'] = true;

			return $login;

		} else {

			$login['status'] = false;

			return $login;
		}

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

				$login['status'] = true;

				return $login;

			} else {

				$login['status'] = 'Wrong password';

				return $login;
			}

		} else {

			$login['status'] = 'Wrong Username';

			return $login;
		}

	}

}
