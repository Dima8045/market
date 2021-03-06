<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->decimal('price', 13, 2)->default(0);
            $table->string('image_folder')->nullable();
            $table->bigInteger('sort_order')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('unit_id')
                ->on('units')
                ->references('id')
                ->onUpdate('set null')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
        });
        Schema::dropIfExists('products');
    }
}
