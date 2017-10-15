<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesMorphTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_morph', function (Blueprint $table) {
            $table->unsignedInteger('image_id');
            $table->morphs('model');
            $table->tinyInteger('order')->default(0)->unsigned();
            $table->boolean('main')->default(false);
            $table->foreign('image_id')->references('id')->on('images')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_morph');
    }
}
