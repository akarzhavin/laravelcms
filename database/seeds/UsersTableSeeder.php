<?php


use \Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Http\Models\User::create([
            'email'    => 'test@example.com',
            'password' => Hash::make('passw0rd'),
            'role_id' => 1
        ]);
        App\Http\Models\User::create([
            'email'    => 'guest@example.com',
            'password' => Hash::make('passw0rd'),
            'role_id' => 2
        ]);
        App\Http\Models\User::create([
            'email'    => 'user@example.com',
            'password' => Hash::make('passw0rd'),
            'role_id' => 3
        ]);


    }
}
