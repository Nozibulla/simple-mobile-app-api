<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEndUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('endusers', function (Blueprint $table) {

			$table->increments('id');
			$table->string('username');
			$table->string('email')->unique();
			$table->string('pass', 60);
			$table->string('mobile');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::drop('endusers');
	}
}
