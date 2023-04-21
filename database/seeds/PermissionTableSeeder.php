<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Permission::insert([
            // permissions for users CRUD
            [
                'name'=>'create-user',
                'display_name'=>'Create User',
                'description'=>'User who can create other users',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'edit-user',
                'display_name'=>'Edit User',
                'description'=>'User who can edit other users',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'delete-user',
                'display_name'=>'Delete User',
                'description'=>'User who can delete other users',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'read-users',
                'display_name'=>'Read Users',
                'description'=>'User who can read from users table',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            // permissions for images CRUD
            [
                'name'=>'read-images',
                'display_name'=>'Read Images',
                'description'=>'User who can read from images table',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'edit-images',
                'display_name'=>'Edit images',
                'description'=>'User who can edit images',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'create-images',
                'display_name'=>'Create images',
                'description'=>'User who can upload images',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'delete-images',
                'display_name'=>'Delete images',
                'description'=>'User who can delete images',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            // permissions for categories CRUD
            [
                'name'=>'read-categories',
                'display_name'=>'Read categories',
                'description'=>'User who can read from images table',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'edit-categories',
                'display_name'=>'Edit categories',
                'description'=>'User who can edit categories',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'create-categories',
                'display_name'=>'Create categories',
                'description'=>'User who can upload categories',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=>'delete-categories',
                'display_name'=>'Delete categories',
                'description'=>'User who can delete categories',
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            ],
        ]);

        \DB::table('permission_role')->insert([
            // permissions for administrators
            [
                'permission_id'=>1,
                'role_id'=>1,
            ],
            [
                'permission_id'=>2,
                'role_id'=>1,
            ],
            [
                'permission_id'=>3,
                'role_id'=>1,
            ],
            [
                'permission_id'=>4,
                'role_id'=>1,
            ],
            [
                'permission_id'=>5,
                'role_id'=>1,
            ],
            [
                'permission_id'=>6,
                'role_id'=>1,
            ],
            [
                'permission_id'=>7,
                'role_id'=>1,
            ],
            [
                'permission_id'=>8,
                'role_id'=>1,
            ],
            // permissions for advanced users
            [
                'permission_id'=>5,
                'role_id'=>2,
            ],
            [
                'permission_id'=>6,
                'role_id'=>2,
            ],
            [
                'permission_id'=>7,
                'role_id'=>2,
            ]
        ]);
    }
}
