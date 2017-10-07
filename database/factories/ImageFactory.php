<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 01.08.2017
 * Time: 15:43
 */
$factory->define(App\Http\Models\Images::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'hash_name' => '1afa148eb41f2e7103f21410bf48346c' . '.jpg',
        'dir' => 'public',
        'title' => $faker->word,
        'alt' => $faker->word,
    ];
});
