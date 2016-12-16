<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPrayalongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pray_along', function ($table) {
            $table->boolean('prayed')->default(0);
            $table->integer('response_prayer_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pray_along', function ($table) {
            $table->dropColumn('prayed');
            $table->dropColumn('response_prayer_id');
        });
    }
}
