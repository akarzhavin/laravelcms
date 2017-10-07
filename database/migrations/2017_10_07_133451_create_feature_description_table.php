<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_description', function (Blueprint $table) {
            $table->unsignedInteger('feature_id')->primary();
            $table->string('title', 255);
            $table->text('description')->default('');
            $table->string('prefix', 128)->default('');
            $table->string('suffix', 128)->default('');

            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_description');
    }
}
