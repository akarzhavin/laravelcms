<?php

use Illuminate\Database\Seeder;

class ProductDescriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = App::make(Faker\Generator::class);
        $faker->unique($reset = true)->numberBetween;
        factory(App\Http\Models\ProductDescription::class, 100)->create();
    }
}
