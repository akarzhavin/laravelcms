<?php

use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = App\Http\Models\Feature::all();
        $categories = App\Http\Models\Category::all();

        foreach($categories as $category){
            for($i = $category->level + 1; $i < 5; $i++){
                $feature_id = $features->random()->id;
                factory(App\Http\Models\Filter::class, 'feature', 1)
                    ->create(['feature_id' => $feature_id])
                    ->each(function($u) use ($category, $feature_id) {
                        $u->categories()->toggle($category->id);
                });
            }
        }
    }
}