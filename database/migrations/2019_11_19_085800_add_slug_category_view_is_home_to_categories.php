<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugCategoryViewIsHomeToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('slug')->after('parent');
            $table->enum('category_view', ['0', '1'])->nullable()->comment('0=list, 1=page')->after('slug');
            $table->enum('is_home', ['0', '1'])->default('0')->comment('0=not home, 1=is home')->after('category_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
