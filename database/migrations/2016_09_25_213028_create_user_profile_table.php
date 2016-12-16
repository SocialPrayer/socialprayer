<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('user_profiles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->default(0);
			$table->foreign('user_id')
				->references('id')
				->on('users');
			$table->string('email')->unique();
			$table->string('firstname')->nullable();
			$table->string('middlename')->nullable();
			$table->string('lastname')->nullable();
			$table->char('sex', 1)->nullable();
			$table->string('marital_status')->nullable();
			$table->string('spouse_name')->nullable();
			$table->json('kids')->nullable();
			$table->json('address')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('bible')->nullable();
			$table->string('religion')->nullable();
			$table->string('denomination')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('user_profiles');
	}
}
