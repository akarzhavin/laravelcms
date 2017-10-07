<?php

use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Http\Models\Feature::class, 50)->create();

        //Categories attach to features
        $categories_ids = range(1, 50); //Range product ids
        $features = App\Http\Models\Feature::all();
        foreach($features as $feature){
            $categories_rand = array_filter(array_rand($categories_ids, 5));
            $feature->categories()->attach($categories_rand);
        }
    }
}
