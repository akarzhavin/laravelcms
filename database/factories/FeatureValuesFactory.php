<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 14.08.2017
 * Time: 20:11
 */

$factory->defineAs(App\Http\Models\FeatureValue::class, 'CheckSingle', function (Faker\Generator $faker) {
    return [
        'value_bool' => $faker->boolean,
    ];
});

$factory->defineAs(App\Http\Models\FeatureValue::class, 'CheckMulti', function (Faker\Generator $faker) {
    return [
        'value_string' => $faker->word,
    ];
});

$factory->defineAs(App\Http\Models\FeatureValue::class, 'SelectNum', function (Faker\Generator $faker) {
    return [
        'value_double' => $faker->randomNumber(),
    ];
});

$factory->defineAs(App\Http\Models\FeatureValue::class, 'SelectText', function (Faker\Generator $faker) {
    return [
        'value_string' => $faker->word,
    ];
});