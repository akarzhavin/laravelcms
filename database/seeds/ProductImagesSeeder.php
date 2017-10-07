<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Product;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $range = range(1,50);

        foreach($products as $product){
            $product->images()->attach([rand(1,50) => ['main' => 1]]);

            $i = array_filter(array_rand($range, rand(2,5)));
            $product->images()->toggle($i);
        }
    }
}
