<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address', 50);
            $table->string('user_agent', 255);
            $table->string('url', 255);
            $table->text('description');
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('created_by');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_users');
    }
}
