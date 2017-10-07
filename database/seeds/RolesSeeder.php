<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'guest',
            'moderator',
        ];

        foreach($roles as $role){
            App\Http\Models\Roles::create(['type' => $role]);
        }
    }
}
