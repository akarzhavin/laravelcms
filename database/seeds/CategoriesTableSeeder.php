<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 50)->create();

        $categories = Category::all();
        $all = range(0, 50);
        array_shift($all); //Извлекаем нуль
        array_shift($all); //Извлекаем единицу
        shuffle($all);


        $level[0] = [1];
        $level[1] = array_slice($all, 0, 20);
        $level[2] = array_slice($all, 20, 15);
        $level[3] = array_slice($all, 35, 8);
        $level[4] = array_slice($all, 43, 7);


        $category = $categories->where('id', 1)->first();
        $category->id_path = $category->id;
        $category->level = 0;
        $category->save();

        foreach($level as $key => $value){
            if($key == 0){ continue; }
            foreach($value as $item){
                $category = $categories->where('id', $item)->first();

                $parentKey = array_rand($level[$key - 1], 1);
                $parentId = $level[$key - 1][$parentKey];
                $category->parent_id = $parentId;

                $parentPathId = $categories->where('id', $parentId)->first();
                $parentPathArr = explode('/', $parentPathId->id_path);
                $parentPathArr[] = $item;
                $parentPathArr = array_filter($parentPathArr);
                $currentPathId = implode('/', $parentPathArr);
                $category->id_path = $currentPathId;

                $category->level = $key;
                $category->save();
            }
        }
    }
}
