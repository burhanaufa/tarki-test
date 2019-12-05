<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyRegionIdOnLogUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_users', function (Blueprint $table) {
            $table->dropForeign('log_users_region_id_foreign');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_users', function (Blueprint $table) {
            //
        });
    }
}
