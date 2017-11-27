<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 26.11.2017
 * Time: 20:39
 */
$factory->define(App\Http\Models\Gallery::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name
    ];
});
