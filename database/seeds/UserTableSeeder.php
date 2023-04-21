<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
                'first_name' => 'admin_f_name',
                'last_name' => 'admin_l_name',
                'status' => 'regular',
                'username' => 'testadmin',
                'email' => 'admin@test.com',
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'advanced_f_name',
                'last_name' => 'advanced_l_name',
                'status' => 'regular',
                'username' => 'testadvanced',
                'email' => 'advanced@test.com',
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'user_f_name',
                'last_name' => 'user_l_name',
                'status' => 'regular',
                'username' => 'testuser',
                'email' => 'user@test.com',
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'suspended_f_name',
                'last_name' => 'suspended_l_name',
                'status' => 'suspended',
                'username' => 'testsuspended',
                'email' => 'suspended@test.com',
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'canceled_f_name',
                'last_name' => 'canceled_l_name',
                'email' => 'canceled@test.com',
                'username' => 'testcanceled',
                'status' => 'canceled',
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
            ],
        ]);
    }
}
