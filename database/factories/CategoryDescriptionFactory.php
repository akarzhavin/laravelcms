<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 01.08.2017
 * Time: 13:40
 */
$factory->define(App\Http\Models\CategoryDescription::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'category_id' => $faker->unique()->numberBetween(1, 50),
        'title' => $faker->word,
        'description' => $faker->text,
        'meta_keywords' => $faker->word,
        'meta_description' => $faker->word,
        'page_title' => $faker->word,
    ];
});