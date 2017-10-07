<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('feature_id');
            $table->boolean('value_bool')->nullable();
            $table->string('value_string', 255)->nullable();
            $table->double('value_double', 12, 2)->nullable();
            $table->string('description', 255)->nullable();
            $table->unsignedTinyInteger('order')->default(0);

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
        Schema::dropIfExists('feature_values');
    }
}
