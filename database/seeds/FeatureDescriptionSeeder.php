<?php

use Illuminate\Database\Seeder;

class FeatureDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++){
            factory(App\Http\Models\FeatureDescription::class)->create(['feature_id' => $i]);
        }
    }
}
