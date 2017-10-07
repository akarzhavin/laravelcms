<?php


use Illuminate\Database\Seeder;
use App\Http\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 100)->create()->each(function($u) {
            $array = range(2, 50);
            $ids = array_filter(array_rand($array, rand(2,4)));
            if(array_search(1, $ids) === false){
                $ids[] = 1;
            }
            $u->categories()->attach($ids, ['link_type' => 'A']);
        });

        $products = Product::all();
        foreach($products as $product){
            $attachIDs = $product->categories->pluck('id')->toArray();
            if(is_array($attachIDs) && isset($attachIDs[0])){
                $firstId = array_shift($attachIDs);
                $attachIDs[$firstId] = ['link_type' => 'M'];
            } else {
                $attachIDs = array($attachIDs => ['link_type' => 'M']);
            }
            $product->categories()->sync($attachIDs);
        }
    }
}
