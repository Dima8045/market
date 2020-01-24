<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('alt')->nullable();
            $table->bigInteger('sort_order')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->on('categories')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_images', function (Blueprint $table) {
           $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('category_images');
    }
}
