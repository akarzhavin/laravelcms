<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->string('type', 128);
            $table->unsignedInteger('feature_id')->nullable()->index();
            $table->char('status', 1)->default('A');
            $table->unsignedTinyInteger('order')->default(0);
            $table->char('display', 1)->default('D');
            $table->tinyInteger('display_count')->default(10);
            $table->string('other', 255)->nullable();

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filters');
    }
}
