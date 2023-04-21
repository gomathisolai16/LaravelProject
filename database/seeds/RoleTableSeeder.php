<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::insert([
            [
                'name'=>'admin',
                'display_name'=>'Administrator',
                'description'=>'User with administrator role is pillaged user',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'advanced-user',
                'display_name'=>'Advanced User',
                'description'=>'A middle priority for user',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'regular-user',
                'display_name'=>'Regular User',
                'description'=>'A lowest priority for user',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
        ]);

        \DB::table('role_user')->insert([
            [
                'user_id'=>1,
                'role_id'=>1,
            ],
            [
                'user_id'=>2,
                'role_id'=>2,
            ],
            [
                'user_id'=>3,
                'role_id'=>3,
            ],
        ]);
    }
}
