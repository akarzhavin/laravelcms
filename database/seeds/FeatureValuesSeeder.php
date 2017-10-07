<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Relations\Relation;

class FeatureValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = App\Http\Models\Feature::all();
        foreach($features as $feature){
            if($feature->type == 'CheckSingle'){
                $count = 1;
            } else {
                $count = mt_rand(5,15);
            }
            factory(App\Http\Models\FeatureValue::class, $feature->type, $count)
                ->create(['feature_id' => $feature->id]);
        }
    }
}
