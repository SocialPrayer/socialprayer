<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlterUserProfileTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('user_profiles', function ($table) {
			$table->string('middlename')->nullable()->after('firstname');
			$table->string('sex', 1)->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('user_profiles', function ($table) {
			$table->dropColumn('middlename');
			$table->string('sex', 1)->change();
		});
	}
}
