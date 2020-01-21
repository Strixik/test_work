<?php

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
        DB::table('users')->insert([[
            'email' => 'strix@test.com',
            'password' => bcrypt('123456'),
            'api_token' => null,
            'role' => 0
        ],
            [
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'api_token' => null,
                'role' => 1
            ]]);
    }
}
