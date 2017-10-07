<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 14.08.2017
 * Time: 16:24
 */

$factory->define(App\Http\Models\FeatureDescription::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->text,
    ];
});