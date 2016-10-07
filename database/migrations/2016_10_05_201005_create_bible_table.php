<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibleTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('bibles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('language');
			$table->string('version');
			$table->string('verse_full');
			$table->string('book');
			$table->smallInteger('chapter');
			$table->smallInteger('verse');
			$table->text('text');
			$table->timestamps();
			$table->index(['version', 'book']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('bibles');
	}
}
