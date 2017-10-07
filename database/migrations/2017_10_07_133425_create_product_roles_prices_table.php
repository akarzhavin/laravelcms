<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRolesPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_roles_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('role_id')->nullable();
            $table->decimal('recommend_price', 12, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->text('discount')->default('');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_roles_prices');
    }
}
