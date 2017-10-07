<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->primary();
            $table->string('title', 255);
            $table->string('short_title', 60)->default('');
            $table->string('short_description', 255)->default('');
            $table->text('full_description')->default('');
            $table->string('meta_keywords', 255)->default('');
            $table->string('meta_description', 255)->default('');
            $table->string('search_words', 255)->default('');
            $table->string('page_title', 255)->default('');
            $table->string('promo_text', 255)->default('');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_descriptions');
    }
}
