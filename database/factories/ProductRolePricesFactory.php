<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 09.08.2017
 * Time: 14:58
 */
$factory->define(App\Http\Models\ProductRolePrices::class, function (Faker\Generator $faker) {

    if(rand(0, 1)){
        $percentage_discount = rand(0, 80);
    } else {
        $percentage_discount = 0;
    }

    return [
        'product_id' => $faker->unique()->numberBetween(1, 100),
        'role_id' => NULL,
        'recommend_price' => '',
        'price' => $faker->randomNumber(),
        'discount' => '',
    ];
});