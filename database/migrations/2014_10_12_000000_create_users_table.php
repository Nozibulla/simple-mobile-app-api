<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('name_on_linkbar');
			$table->timestamps();
		});

		Schema::create('writers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('writer');
			$table->string('writer_on_linkbar');
			$table->timestamps();
		});

		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->string('book_name');
			$table->string('book_link');
			$table->string('thumbnail');
			$table->integer('writer_id')->unsigned();
			$table->foreign('writer_id')->references('id')->on('writers');
			$table->timestamps();
		});

		/*Schema::create('product_writer', function (Blueprint $table) {

			$table->integer('writer_id')->unsigned()->index();

			$table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');

			$table->integer('product_id')->unsigned()->index();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

			$table->timestamps();
		});*/

		Schema::create('category_product', function (Blueprint $table) {

			$table->integer('category_id')->unsigned()->index();

			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

			$table->integer('product_id')->unsigned()->index();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('users');
		Schema::dropIfExists('products');
		Schema::dropIfExists('categories');
		Schema::dropIfExists('category_product');
		Schema::dropIfExists('writers');
		/*Schema::drop('product_writer');*/
	}
}
