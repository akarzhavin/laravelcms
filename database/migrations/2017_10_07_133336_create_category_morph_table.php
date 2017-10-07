<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryMorphTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_morph', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->morphs('model');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->char('link_type', 1)->default('A');
            $table->tinyInteger('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_morph');
    }
}
