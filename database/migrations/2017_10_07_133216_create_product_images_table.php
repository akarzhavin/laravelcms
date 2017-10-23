<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->tinyInteger('order')->default(0)->unsigned();
            $table->boolean('main')->default(false);

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('image_id')
                ->references('id')->on('images')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
