<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name', 50);
            $table->text('image');
            $table->integer('parent')->nullable();
            $table->enum('is_menu', ['0', '1'])->nullable()->comment('0=not menu, 1=is_menu');
            $table->enum('is_enable', ['0', '1'])->default('0')->comment('0=disable, 1=enable');
            $table->bigInteger('created_by');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
