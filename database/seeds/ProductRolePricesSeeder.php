<?php

use Illuminate\Database\Seeder;

class ProductRolePricesSeeder extends Seeder
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

        factory(App\Http\Models\ProductRolePrices::class, 100)->create();
    }
}
