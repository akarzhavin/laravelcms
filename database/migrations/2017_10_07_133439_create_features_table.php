<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('type', 255);
            $table->boolean('display_on_product')->default(1);
            $table->boolean('display_on_catalog')->default(1);
            $table->boolean('display_on_header')->default(0);
            $table->char('status', 1)->default('A');
            $table->unsignedTinyInteger('order')->default(0);
            $table->boolean('comparison')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
