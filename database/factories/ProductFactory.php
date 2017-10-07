<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 01.08.2017
 * Time: 14:19
 */
$factory->define(App\Http\Models\Product::class, function (Faker\Generator $faker) {
    $status = ['A','A','A','A','A','A','A','D','D','H'];
    return [
//        'product_code' => $faker->ean8(),
        'status' => $status[rand(0,9)],
    ];
});