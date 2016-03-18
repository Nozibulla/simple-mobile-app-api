<?php

/*
|--------------------------------------------------------------------------
| Routes File REST API
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('lara-api/books', 'ApiController@products');
Route::get('lara-api/categories', 'ApiController@categories');
Route::get('lara-api/category/{cat_name}', 'ApiController@productByCategorie');
Route::get('lara-api/writers', 'ApiController@writers');
Route::get('lara-api/writer/{writer_name}', 'ApiController@productsByWriter');
Route::get('lara-api/categorieswithproducts', 'ApiController@categoriesWithProducts');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/', function () {
		return 'Eboimelabd';
	});

	Route::get('/home', 'HomeController@index');
	Route::post('/save_product', 'ProductController@save');
	Route::get('/add_product', 'ProductController@addProduct');
	Route::get('/add_category', 'ProductController@addCategory');
	Route::post('/save_category', 'ProductController@saveCategory');
	Route::post('/save_edited_category', 'ProductController@saveEditedCategory');
	Route::post('/deletecategory', 'ProductController@deleteCategory');
});
