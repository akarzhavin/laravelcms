<?php

use Illuminate\Database\Seeder;
use App\Http\Models\CategoryDescription;
use Faker\Generator;

class CategoryDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Http\Models\CategoryDescription::class, 50)->create();
        $category = App\Http\Models\Category::find(1);
        $category->description->title = 'Все категории';
        $category->description->save();
    }
}
