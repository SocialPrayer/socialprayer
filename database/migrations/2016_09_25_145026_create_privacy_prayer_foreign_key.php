<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePrivacyPrayerForeignKey extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('prayers', function ($table) {
			$table->integer('privacy_setting_id')->unsigned()->default(0);
			$table->foreign('privacy_setting_id')
				->references('id')
				->on('privacy_settings');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('prayers', function ($table) {
			$table->dropColumn('privacy_setting_id');
			$table->dropForeign('prayers_privacy_setting_id_foreign');
		});
	}
}
