<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 01.08.2017
 * Time: 13:36
 */
$factory->define(App\Http\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'level' => 1,
        'id_path' => ''
    ];
});