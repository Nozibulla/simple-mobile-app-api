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

		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->string('product_name');
			$table->string('writer');
			$table->string('category');
			$table->string('thumbnail');
			$table->timestamps();
		});

		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
		Schema::drop('products');
		Schema::drop('categories');
	}
}
