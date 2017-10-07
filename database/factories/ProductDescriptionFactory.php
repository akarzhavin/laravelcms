<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 09.08.2017
 * Time: 14:45
 */
$factory->define(App\Http\Models\ProductDescription::class, function (Faker\Generator $faker) {

    $id = $faker->unique()->numberBetween(1, 100); //Faker unique bug
    $name = $faker->word;
    $shortDescription = $faker->sentence;

    return [
        'product_id' => $id,
        'title' => $name,
        'short_title' => $name,
        'short_description' => $shortDescription,
        'full_description' => $faker->text,
    ];
});