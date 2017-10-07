<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Product;

class ProductFeaturePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        foreach($products as $product){
            foreach($product->features as $feature){
                $value_id = $feature->values->random()->id;
                $product->featurePivot()->create(['feature_id' => $feature->id, 'value_id' => $value_id]);
            }
        }
    }
}
