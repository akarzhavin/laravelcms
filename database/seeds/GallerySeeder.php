<?php

use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Http\Models\Gallery::class, 20)->create()->each(function($u) {
            $u->images()->attach(rand (1, 50));
        });
    }
}
