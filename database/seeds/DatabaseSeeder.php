<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::truncate();

        DB::table('users')->insert([
            'name' => 'Jhon Alexander Perez Valencia',
            'email' => 'alex16jpv@gmail.com',
            'password' => bcrypt('123456'),
            'api_token' => str_random(40)
        ]);
    }
}
