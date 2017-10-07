<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 21.08.2017
 * Time: 14:51
 */
$factory->define(App\Http\Models\Feature::class, function (Faker\Generator $faker) {

    $types = [
        'CheckMulti',
        'CheckSingle',
        'SelectNum',
        'SelectText',
    ];

    return ['type' => $types[mt_rand(0, count($types) - 1)]];
});
