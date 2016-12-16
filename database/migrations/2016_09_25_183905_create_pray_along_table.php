<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrayAlongTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pray_along', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('prayer_id')->unsigned()->default(0);
			$table->integer('user_id')->unsigned()->default(0);
			$table->foreign('prayer_id')
				->references('id')
				->on('prayers');
			$table->foreign('user_id')
				->references('id')
				->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('pray_along');
	}
}
