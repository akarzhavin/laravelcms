<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 30.08.2017
 * Time: 22:25
 */
$factory->defineAs(App\Http\Models\Filter::class, 'feature', function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'type' => 'feature',
    ];
});
