<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_description', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->primary();
            $table->string('title', 255);
            $table->mediumText('description')->default('');
            $table->string('meta_keywords', 255)->default('');
            $table->string('meta_description', 255)->default('');
            $table->string('page_title', 255)->default('');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_description');
    }
}
