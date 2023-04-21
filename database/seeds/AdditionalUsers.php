<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdditionalUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1500; $i < 1511; $i++) {
            \App\Models\User::insert([
                [
                    'id' => $i,
                    'first_name' => 'admin_f_name'.$i,
                    'last_name' => 'admin_l_name'.$i,
                    'status' => 'regular',
                    'username' => 'testadmin'.$i,
                    'email' => 'admin'.$i.'@test.com',
                    'password' => bcrypt('secret'),
                    'remember_token' => Str::random(10),
                ]
            ]);

            \DB::table('role_user')->insert([
                [
                    'user_id' => $i,
                    'role_id' => 3,
                ]
            ]);
        }
    }
}
